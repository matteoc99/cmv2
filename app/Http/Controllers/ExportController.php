<?php

namespace App\Http\Controllers;

use App\Exports\CondominiumExport;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function exportToExcel(Condominium $condominium)
    {
        $tickets = $condominium->tickets()->select(["title", "desc", "price", "status_id", "contract_type_id"])->with(array("status", "contractType"))->get();


        $data = array(
            array("title" => "Title", "desc" => "Description", "price" => "Price", "status" => "Status", "contract_type" => "Contract Type"),
        );

        foreach ($tickets as $ticket) {
            $row = $ticket->toArray();
            unset($row["status_id"]);
            unset($row["contract_type_id"]);
            unset($row["status"]);
            unset($row["contract_type"]);
            if (!is_null($ticket->status()->get()->first()))
                $row["status"] = $ticket->status()->get()->first()->name();
            else
                $row["status"] = "";
            if (!is_null($ticket->contractType()->get()->first()))
                $row["contract_type"] = $ticket->contractType()->get()->first()->name();
            else
                $row["contract_type"] = "";
            array_push($data, $row);
        }

        $fileName = "{$condominium->name}_ticket_" . date('Ymd') . ".xlsx";

        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        $resp = "";
        foreach ($data as $row) {
            // filter data
            $resp .= implode("\t", array_values($row)) . "\n";
        }
        echo $resp;
    }
}
