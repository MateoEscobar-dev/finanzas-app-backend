/**
 * Ejemplo de implementación Frontend con React
 * Sistema de Gestión de Servidores con WebSocket
 */

import { useEffect, useState } from "react";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Configurar Echo globalmente (hacer una sola vez en tu app)
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: "e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346", // ✅ REVERB_APP_KEY del .env
    wsHost: "paneladmin.local", // ✅ Mismo que REVERB_HOST en .env
    wsPort: 6001, // ✅ Mismo que REVERB_PORT en .env
    wssPort: 6001,
    forceTLS: false, // false porque usamos http (REVERB_SCHEME=http)
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});

// Hook personalizado para operaciones de servidor
export const useServerOperation = () => {
    const [progress, setProgress] = useState(0);
    const [message, setMessage] = useState("");
    const [severity, setSeverity] = useState("info");
    const [isComplete, setIsComplete] = useState(false);
    const [error, setError] = useState(null);

    const executeOperation = async (endpoint, data, token) => {
        // Generar operationId único
        const operationId = `op_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;

        // Resetear estado
        setProgress(0);
        setMessage("");
        setIsComplete(false);
        setError(null);

        // Suscribirse al canal WebSocket
        const channel = window.Echo.channel(`server-actions.${operationId}`);

        channel
            .listen(".progress", (event) => {
                console.log("Progress event:", event);
                setProgress(event.progress);
                setMessage(event.message);
                setSeverity(event.severity);
            })
            .listen(".complete", (event) => {
                console.log("Complete event:", event);
                setProgress(100);
                setMessage(event.message);
                setSeverity("success");
                setIsComplete(true);

                // Desuscribirse del canal
                window.Echo.leave(`server-actions.${operationId}`);
            })
            .listen(".error", (event) => {
                console.error("Error event:", event);
                setError({
                    message: event.message,
                    code: event.errorCode,
                });
                setSeverity("error");

                // Desuscribirse del canal
                window.Echo.leave(`server-actions.${operationId}`);
            });

        try {
            // Hacer la petición HTTP
            const response = await fetch(endpoint, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify({
                    ...data,
                    operationId,
                }),
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || "Error en la operación");
            }

            return result;
        } catch (err) {
            setError({
                message: err.message,
                code: "HTTP_ERROR",
            });
            throw err;
        }
    };

    return {
        executeOperation,
        progress,
        message,
        severity,
        isComplete,
        error,
    };
};

// Componente de ejemplo: Instalar servidor
export const ServerInstallForm = ({ serverId, token }) => {
    const [domain, setDomain] = useState("");
    const [email, setEmail] = useState("");
    const { executeOperation, progress, message, severity, isComplete, error } =
        useServerOperation();

    const handleInstall = async (e) => {
        e.preventDefault();

        try {
            await executeOperation(
                `/api/server/${serverId}/install`,
                { domain, email },
                token,
            );
        } catch (err) {
            console.error("Install failed:", err);
        }
    };

    return (
        <div className="server-install-form">
            <h2>Instalar Servidor</h2>

            <form onSubmit={handleInstall}>
                <div>
                    <label>Dominio:</label>
                    <input
                        type="text"
                        value={domain}
                        onChange={(e) => setDomain(e.target.value)}
                        required
                    />
                </div>

                <div>
                    <label>Email:</label>
                    <input
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                    />
                </div>

                <button type="submit" disabled={progress > 0 && !isComplete}>
                    {progress > 0 && !isComplete ? "Instalando..." : "Instalar"}
                </button>
            </form>

            {/* Barra de progreso */}
            {progress > 0 && (
                <div className="progress-container">
                    <div
                        className="progress-bar"
                        style={{ width: `${progress}%` }}
                    >
                        {progress}%
                    </div>
                    <p className={`message ${severity}`}>{message}</p>
                </div>
            )}

            {/* Mensaje de éxito */}
            {isComplete && (
                <div className="alert alert-success">
                    ✅ Instalación completada correctamente
                </div>
            )}

            {/* Mensaje de error */}
            {error && (
                <div className="alert alert-error">
                    ❌ Error: {error.message} (Código: {error.code})
                </div>
            )}
        </div>
    );
};

// Componente de ejemplo: Validar estado del servidor
export const ServerStatusValidator = ({ serverId, token }) => {
    const [status, setStatus] = useState(null);
    const { executeOperation, progress, message, isComplete, error } =
        useServerOperation();

    const handleValidate = async () => {
        try {
            const result = await executeOperation(
                `/api/server/${serverId}/validate-status`,
                {},
                token,
            );

            if (result.success) {
                setStatus(result.data);
            }
        } catch (err) {
            console.error("Validation failed:", err);
        }
    };

    return (
        <div className="server-status-validator">
            <h2>Validar Estado del Servidor</h2>

            <button
                onClick={handleValidate}
                disabled={progress > 0 && !isComplete}
            >
                {progress > 0 && !isComplete
                    ? "Validando..."
                    : "Validar Estado"}
            </button>

            {progress > 0 && (
                <div className="progress-info">
                    <p>
                        {progress}% - {message}
                    </p>
                </div>
            )}

            {status && isComplete && (
                <div className="server-status">
                    <h3>Estado del Servidor</h3>
                    <ul>
                        <li>Estado: {status.status}</li>
                        <li>Servicios activos: {status.services_count}</li>
                        <li>Uso de disco: {status.disk_usage}</li>
                        <li>Uso de memoria: {status.memory_usage}</li>
                        <li>Última verificación: {status.last_check}</li>
                    </ul>
                </div>
            )}

            {error && (
                <div className="alert alert-error">❌ {error.message}</div>
            )}
        </div>
    );
};

// Componente de ejemplo: Agregar programa
export const AddProgramForm = ({ serverId, token }) => {
    const [programs, setPrograms] = useState([]);
    const [selectedProgram, setSelectedProgram] = useState("");
    const { executeOperation, progress, message, isComplete, error } =
        useServerOperation();

    useEffect(() => {
        // Cargar programas disponibles
        fetch("/api/servers/available-programs", {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    setPrograms(data.data.programs);
                }
            })
            .catch((err) => console.error("Error loading programs:", err));
    }, [token]);

    const handleAddProgram = async (e) => {
        e.preventDefault();

        try {
            await executeOperation(
                `/api/server/${serverId}/add-program`,
                { programId: parseInt(selectedProgram) },
                token,
            );
        } catch (err) {
            console.error("Add program failed:", err);
        }
    };

    return (
        <div className="add-program-form">
            <h2>Agregar Programa al Servidor</h2>

            <form onSubmit={handleAddProgram}>
                <div>
                    <label>Seleccionar Programa:</label>
                    <select
                        value={selectedProgram}
                        onChange={(e) => setSelectedProgram(e.target.value)}
                        required
                    >
                        <option value="">-- Seleccionar --</option>
                        {programs.map((program) => (
                            <option key={program.id} value={program.id}>
                                {program.name} ({program.version})
                            </option>
                        ))}
                    </select>
                </div>

                <button type="submit" disabled={progress > 0 && !isComplete}>
                    {progress > 0 && !isComplete
                        ? "Instalando..."
                        : "Agregar Programa"}
                </button>
            </form>

            {progress > 0 && (
                <div className="progress-container">
                    <div
                        className="progress-bar"
                        style={{ width: `${progress}%` }}
                    >
                        {progress}%
                    </div>
                    <p>{message}</p>
                </div>
            )}

            {isComplete && (
                <div className="alert alert-success">
                    ✅ Programa agregado correctamente
                </div>
            )}

            {error && (
                <div className="alert alert-error">❌ {error.message}</div>
            )}
        </div>
    );
};

// Estilos CSS de ejemplo
const styles = `
.progress-container {
    margin: 20px 0;
}

.progress-bar {
    height: 30px;
    background: linear-gradient(to right, #4caf50, #8bc34a);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    transition: width 0.3s ease;
}

.message {
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px;
}

.message.info {
    background: #e3f2fd;
    color: #1976d2;
}

.message.success {
    background: #e8f5e9;
    color: #388e3c;
}

.message.warning {
    background: #fff3e0;
    color: #f57c00;
}

.message.error {
    background: #ffebee;
    color: #c62828;
}

.alert {
    padding: 15px;
    margin: 15px 0;
    border-radius: 5px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.server-status ul {
    list-style: none;
    padding: 0;
}

.server-status li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}
`;
