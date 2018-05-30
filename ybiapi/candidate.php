<?php
include("../db/db_conf.php");
/**
 *
 */
class Candidate
{
var $connection;
  function __construct()
  {
    $this->connection = db_connect();
  }

  public function getAllCandidates(){
    $result = db_select("SELECT * FROM ybi_basvuru");
    if(!$result){
      return '{"result":"ERROR"}';
    }else {
      return json_encode($result);
    }
  }

  public function getCandidate($id){
    $result = db_select("SELECT * FROM ybi_basvuru where id = $id");
    if(!$result){
      return '{"result":"ERROR"}';
    }else {
      return json_encode($result);
    }
  }

  public function insertCandidate($inputJson){
    $inputObj = json_decode($inputJson);
    if(db_query("INSERT INTO ybi_basvuru (BASV_YIL,BASV_TURU,FS_ADI_SOYADI,FS_KURUM_GOREV,UNVAN,ADI_SOYADI,DOG_TAR,DOG_YER,TEL_EV_IS,TEL_CEP,ANA_BD,ARS_ALAN,YAY_SAY,ATIF_KENDI,ATIF_BASKASI,GEREKCE,CV_PATH,TARIHSAAT,SECICI_UYE,SECICI_UYE2,SECICI_UYE3,MESLEK,EPOSTA,KISISEL_WEB,YAY_SAY_DIGER,H_INDEX,ALINMIS_PATENT,PATENT_BASVURU,UNIV_ICI_PROJE,UNIV_DISI_PROJE,TEZ_LISANS,TEZ_LISANSUSTU,TEZ_DOKTORA,GEREKCE2,GEREKCE3,FOTO_PATH) VALUES (2018, 0, '$inputObj->adi_soyadi', '','$inputObj->unvan', '$inputObj->adi_soyadi', '$inputObj->dog_tar', '$inputObj->dog_yer','$inputObj->tel_ev_is', '$inputObj->tel_cep', '$inputObj->ana_bd', '$inputObj->ars_alan', $inputObj->yay_say_sci, $inputObj->atif_kendi, $inputObj->atif_baskasi, '$inputObj->gerekce', '',CURRENT_TIMESTAMP,'', '', '', '$inputObj->meslek', '$inputObj->eposta', '$inputObj->kisisel_web', $inputObj->yay_say_diger, $inputObj->h_index, $inputObj->alinmis_patent, $inputObj->patent_basvuru, $inputObj->univ_ici_proje, $inputObj->univ_disi_proje, $inputObj->tez_lisans, $inputObj->tez_lisansustu, $inputObj->tez_doktora, '$inputObj->gerekce2', '$inputObj->gerekce3','')")){
      return '{"result":"OK"}';
    }else{
      return '{"result":"ERROR"}';
    }
  }

  public function updateCandidate($id,$inputJson){
    $inputObj = json_decode($inputJson);
    if(db_query("UPDATE ybi_basvuru SET WHERE ID = $id")){
      return '{"result":"OK"}';
    }else{
      return '{"result":"ERROR"}';
    }
  }

  public function deleteCandidate($id){
    $result = db_select("DELETE FROM ybi_basvuru where id = $id");
    if(!$result){
      return '{"result":"ERROR"}';
    }else {
      return '{"result":"OK"}';
    }
  }
}


 ?>
