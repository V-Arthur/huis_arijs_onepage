<?php
/**
 * Excel create program
 */
class ExcelExport {
   var $file;
   var $row;

   function ExcelExport() {
      $this->file = $this->__BOF();
      $row = 0;
   }
   function __BOF() {
       return pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
   }

   function __EOF() {
       return pack("ss", 0x0A, 0x00);
   }

   function __writeNum($row, $col, $value) {
       $this->file .= pack("sssss", 0x203, 14, $row, $col, 0x0);
       $this->file .= pack("d", $value);
   }

   function __writeString($row, $col, $value ) {
       $L = strlen($value);
       $this->file .= pack("ssssss", 0x204, 8 + $L, $row, $col, 0x0, $L);
       $this->file .= $value;
   }
   function writeCell($value,$row,$col) {
      if(is_numeric($value)) {
         $this->__writeNum($row,$col,$value);
      }elseif(is_string($value)) {
         $this->__writeString($row,$col,$value);
      }
   }
function addRow($data,$row=null) {
      //If the user doesn't specify a row, use the internal counter.
      if(!isset($row)) {
         $row = $this->row;
         $this->row++;
      }
      for($i = 0; $i<sizeof($data); $i++) {
                                $clean = $data[$i];
                                $cleanI = str_replace("\n", " ", $clean);
                     $cleanII = str_replace("\r", " ", $cleanI);
                               if(strlen($cleanII) > 256)
                               {
                                               $arr = str_split($cleanII, 256);
                                               $cleanII = $arr[0];
                               }
                               if(!empty($cleanII))  $cell = utf8_decode($cleanII);
                               else $cell = " ";
         $this->writeCell($cell,$row,$i);
      }
   }
   function download($filename) {
     global $stringData;
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");;
      header("Content-Disposition: attachment;filename=$filename ");
      header("Content-Transfer-Encoding: binary ");
      $this->write($stringData);
   }
   function write($stringData) {
      if(isset($stringData)) echo $file = $stringData.$this->__EOF();
      else echo $file = $this->file.$this->__EOF();
   }
}