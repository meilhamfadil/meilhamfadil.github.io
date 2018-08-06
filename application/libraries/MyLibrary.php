<?php

class MyLibrary{

    public function dataTable($aColumns, $sIndexColumn, $sTable, $tQuery, $sTablex = '') {
        $CI = & get_instance();
        $aColumns = $aColumns;
        $sIndexColumn = $sIndexColumn;
        $sTable = $sTable;
        $sLimit = "";

        $xDisplayStart = $CI->input->post('iDisplayStart');
        $xDisplayLength = $CI->input->post('iDisplayLength');
        if (($xDisplayStart != '') && $xDisplayLength != '-1') {
            $sLimit = ($xDisplayStart == 0) ? $xDisplayLength : (($xDisplayStart) + 10);
        }

//        echo $sLimit;
        $xOrder = $CI->input->post('iSortCol_0');
        $xSortingCols = $CI->input->post('iSortingCols');
        if (isset($xOrder)) {
            $sOrder0 = "ORDER BY  ";
            for ($i = 0; $i < intval($xSortingCols); $i++) {
                $xSortCol = $CI->input->post('iSortCol_' . $i);
                $xSortDir = $CI->input->post('sSortDir_' . $i);
                $xSortable = $CI->input->post('bSortable_' . intval($xSortCol));
                if ($xSortable == "true") {
                    $sOrder0 .= $aColumns[intval($xSortCol)] . " " . $xSortDir . ", ";
                }
            }
            $sOrder = substr_replace($sOrder0, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        $sWhere = "";
        $xSearch = ($CI->input->get('sSearch') != "") ? $CI->input->get('sSearch') : (($CI->input->post('sSearch')) ? $CI->input->post('sSearch') : '' );
        if ($xSearch != "") {
            $sWhere0 = "AND ("; //"WHERE (";
            for ($i = 0; $i < (count($aColumns) - 1); $i++) {
                $sWhere0 .= $aColumns[$i] . " LIKE '%" . $xSearch . "%' OR ";
            }
            $sWhere = substr_replace($sWhere0, "", -3);
            $sWhere .= ')';
        }
        for ($i = 0; $i < (count($aColumns) - 1); $i++) {
            $xSearchable = ($CI->input->get('bSearchable_' . $i) != "") ? $CI->input->get('bSearchable_' . $i) : (($CI->input->post('bSearchable_' . $i)) ? $CI->input->post('bSearchable_' . $i) : '' );
            $xSearch = ($CI->input->get('sSearch_' . $i) != "") ? $CI->input->get('sSearch_' . $i) : (($CI->input->post('sSearch_' . $i)) ? $CI->input->post('sSearch_' . $i) : '' );
            if ($xSearchable == "true" && $xSearch != '') {
                if ($sWhere === "") : $sWhere = "AND ";
                else : $sWhere .= " AND ";
                endif;
                $sWhere .= "" . $aColumns[($i + 1)] . " LIKE '%" . ($xSearch) . "%' ";
            }
        }
        $nextLimit = (($sLimit - $xDisplayLength) <= 0) ? '' : ($sLimit - $xDisplayLength) . ',';
        $xLimit = $xDisplayLength;

        if ($xDisplayLength == '-1') {
            $sLimit = '';
        } else {
            $sLimit = "LIMIT $nextLimit $xLimit";
        }

        $ssQ = $tQuery . " $sWhere $sOrder $sLimit ";

        $rResult = $CI->db->query($ssQ);
//        echo $CI->db->last_query();
        $sQuery = "SELECT COUNT(*) as aTot FROM ($tQuery) as hafidz WHERE 1=1 $sWhere";
        $rResultFilterTotal = $CI->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->aTot;

        $sQuery = "SELECT COUNT(" . $sIndexColumn . ") as aTot FROM ($tQuery) as hafidz WHERE 1=1 $sWhere";
        $rResultTotal = $CI->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->aTot;
        $xEcho = ($CI->input->get('sEcho') != "") ? $CI->input->get('sEcho') : (($CI->input->post('sEcho')) ? $CI->input->post('sEcho') : '' );
        $output = array(
            "sEcho" => intval($xEcho),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        $resultx = $rResult->result_array();
        foreach ($resultx as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }
        return json_encode($output);
    }

    public function indoDate($date){
        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $e = explode("-", $date);

        if($e[1] == "00"){
            return "-";
        } else {
            return $e[2] . " " . $bulan[floor($e[1])] . " " . $e[0];
        }
    }

    public function postSerialize(){
        $CI = & get_instance();
        $return = null;

        foreach($CI->input->post() as $head => $value){
            if(!is_array($value)){
                $return[$head] = $value;
            }
        }

        return $return;
    }

    public static function listBulan($ke = ""){
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return ($ke == "") ? $bulan : (($ke > 12 || $ke < 1) ? "<kbd class='btn btn-sm btn-danger'>List Bulan :: Wrong Index</kbd>" : $bulan[$ke-1]);
    }

    public static function listBulanArray(){
        $bulan = [
            array("value" => "01", "display" => "Januari"),
            array("value" => "02", "display" => "Februari"),
            array("value" => "03", "display" => "Maret"),
            array("value" => "04", "display" => "April"),
            array("value" => "05", "display" => "Mei"),
            array("value" => "06", "display" => "Juni"),
            array("value" => "07", "display" => "Juli"),
            array("value" => "08", "display" => "Agustus"),
            array("value" => "09", "display" => "September"),
            array("value" => "10", "display" => "Oktober"),
            array("value" => "11", "display" => "November"),
            array("value" => "12", "display" => "Desember")
        ];
        return (object) $bulan;
    }

    public static function listHari($ke = ""){
        $hari = ["Senis", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        return ($ke == "") ? $hari : (($ke > 7 || $ke < 1) ? "<kbd class='btn btn-sm btn-danger'>List Hari :: Wrong Index</kbd>" : $hari[$ke-1]);
    }

    public static function year($from, $until){
        $data = array();
        for($a = $from; $a <= $until; $a++){
            $data[] = $a;
        }
        return $data;
    }

}