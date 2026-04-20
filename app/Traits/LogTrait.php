<?php

namespace App\Traits;

use App\Models\ErrorException;
use App\Models\Logs;
use App\Models\LogsInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

trait LogTrait {
    private $notItems = ["PHPSESSID","_csrfToken","_token","id","clave","_token","_method","imagen"];
    public $validExtensionImage = ["jpg", "jpeg", "png", "gif", "bmp", "webp"];
    public $validExtensionInvoice = ["jpg", "jpeg", "png", "gif", "bmp", "webp", "pdf", "xls", "xlsx", "docx"];
    public $validExtensionVideo = ["mp4", "avi", "mkv"];
    public function set_language($language, $tipo = 1, $table = "users", $id = 0){
        if(array_key_exists($language, config('languages'))){
            session()->put('applocale', $language);
            try {
                if($id == 0){
                    $id = auth()->user()->id;
                }
                if($id){
                    $result = DB::table("$table")
                    ->where('id', $id)
                    ->update(['lang' => $language]);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        if($tipo > 0){
            return back();
        }
    }
    public function createLog($table, $type, $id, $th="", $reason = "")
    {

        $idReturn = 0;
        try {

            $request = Request::instance();
            $params = $request->all();

            $user = (Auth::guard("web")->check()) ? auth()->user()->id : 1;

            $result = Logs::create([
                "table" => $table,
                "id_item" => $id,
                "operation" => $type,
                "reason" => $reason,
                "user" => $user,
                "date" => date("Y-m-d H:i:s"),
                "type"=> ($th !== null && $th !== "") ? 1 : 0,
            ]);
            if($th !== null && $th !== ""){
                ErrorException::create([
                    'id_log' => $result->id,
                    'type' => "",
                    'message' => $th->getMessage(),
                    'params' => json_encode($params),
                    'endpoint' => request()->path(),
                    'result' => "1",
                ]);
            }
            $idReturn = $result->id;
            //event(new NewLogEntry($result, $th));
        } catch (\Throwable $th) {
            //Log::error($th);
        }
        return $idReturn;
    }
    public function saveChangesValues($sent, $row, $table, $resultLogs)
    {
        $changes = [];
        try {
            $changes = $this->checkSendValues($this->notItems, $sent, $row);

            foreach ($changes as $change) {
                LogsInformation::create([
                    'id_log' => $resultLogs,
                    'id_register' => $row->id,
                    'field' => $change["c"],
                    'value' => $change["v"],
                    'new' => $change["n"]
                ]);
            }
        } catch (\Throwable $th) {
            $this->createLog("teachers", "There was an error validating the changes submitted to the form", $row->id, $th, "");
        }
        return $changes;
    }
    function checkSendValues($noCount, $sent, $row)
    {
        $changes = [];
        try {
            $rowArray = $row->toArray();
            foreach ($sent as $key => $details) {
                if (!in_array("$key", $noCount)) {
                    if (isset($rowArray[$key]) && $rowArray[$key] != $details) {
                        $changes[] = ["c" => $key, "v" =>  $rowArray[$key], "n" => $details];
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->createLog("teachers", "There was an error validating the changes submitted to the form", $row->id, $th, "");
        }
        return $changes;
    }
    public function makeLog($register, $btn = ""){
        try{
            $reasonHtml = __("$register->operation") . "<br/><br/>";
            $reasonHtml .= $this->getLogItem($register->id);
            $reasonText = "<div style='height: 120px; overflow: auto;'>" . $reasonHtml . "</div>";
            $btn .= '<button type="button" id="details' . $register->id . '" class="btn btn-info btn-sm details' . $register->id . '" data-trigger="trigger" data-toggle="tooltip" data-placement="left"  data-html="true" title="' . $reasonText . '" data-original-title="' . $reasonText . '" >'.__("CHANGE/REASON").'</button>';
        }catch (\Throwable $th) {
            //Log::error($th);
        }
        return $btn;
    }
    private function getLogItem($idLog){
        $returnString = "";
        try {
            $itemsLogs = LogsInformation::select(["*"])->where([["id_log", "$idLog"]])->get();
            foreach ($itemsLogs as $detailsItem) {
                $field = __(ucfirst(str_replace('_', ' ', $detailsItem->field)));
                $value = $detailsItem->value;
                $new = $detailsItem->new;

                $returnString .= '<strong>' . __("Field") . ':</strong> ' . $field . '<br>' .
                                '<strong>' . __("CHANGE") . ':</strong> ' . $value . '<br> ' .
                                '<strong>' . __("FOR") . ':</strong> ' . $new . '<br/><br>';
            }
        }catch (\Throwable $th) {
            //Log::error($th);
        }
        return $returnString;
    }
    public function makeOperation($text, $btn = "", $count = 0){
        try{
            if (strpos($text, ': ') !== false) {
                $position = strpos($text, ': ');
                $translate = __(substr("$text", 0, $position));
                $rest = __(substr("$text", $position+2));
                $btn = $translate.": ".$rest;
                $posicion = strpos($btn, ": ");
                if ($posicion != false) {
                    $btn = substr_replace($btn, "%", $posicion, 1);
                }

                if(strpos($rest, ': ') != false){
                    if(strpos($rest, ':00') == false && $count == 1){
                    }
                    $btn = $this->makeOperation($btn, "", $count+1);
                }
            }else{
                $btn = __($text);
            }
        }catch (\Throwable $th) {
           // Log::error($th);
        }

        return $btn;
    }
}
