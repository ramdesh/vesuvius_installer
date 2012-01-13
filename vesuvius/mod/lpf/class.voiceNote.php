<?php
/** ******************************************************************************************************************************************************************
*********************************************************************************************************************************************************************
********************************************************************************************************************************************************************
*
* @class        voiceNote
* @version      11
* @author       Greg Miernicki <g@miernicki.com>
* @note         Usage of this class **REQUIRES** that ffmpeg is installed on the system.
*
********************************************************************************************************************************************************************
*********************************************************************************************************************************************************************
**********************************************************************************************************************************************************************/

class voiceNote {

	public $voice_id;
	public $p_uuid;
	public $length;
	public $format;
	public $sample_rate;
	public $channels;
	public $speaker;
	public $url_original;
	public $url_resampled_mp3;
	public $url_resampled_ogg;

	public $Ovoice_id;
	public $Op_uuid;
	public $Olength;
	public $Oformat;
	public $Osample_rate;
	public $Ochannels;
	public $Ospeaker;
	public $Ourl_original;
	public $Ourl_resampled_mp3;
	public $Ourl_resampled_ogg;

	private $sql_voice_id;
	private $sql_p_uuid;
	private $sql_length;
	private $sql_format;
	private $sql_sample_rate;
	private $sql_channels;
	private $sql_speaker;
	private $sql_url_original;
	private $sql_url_resampled_mp3;
	private $sql_url_resampled_ogg;

	public $dataBase64;
	public $data;


	// Constructor
	public function __construct() {

		// init db
		global $global;
		$this->db = $global['db'];

		// init values
		$this->voice_note_id     = null;
		$this->p_uuid            = null;
		$this->length            = null;
		$this->format            = null;
		$this->sample_rate       = null;
		$this->channels          = null;
		$this->speaker           = null;
		$this->url_original      = null;
		$this->url_resampled_mp3 = null;
		$this->url_resampled_ogg = null;

		$this->Ovoice_note_id     = null;
		$this->Op_uuid            = null;
		$this->Olength            = null;
		$this->Oformat            = null;
		$this->Osample_rate       = null;
		$this->Ochannels          = null;
		$this->Ospeaker           = null;
		$this->Ourl_original      = null;
		$this->Ourl_resampled_mp3 = null;
		$this->Ourl_resampled_ogg = null;

		$this->sql_voice_note_id     = null;
		$this->sql_p_uuid            = null;
		$this->sql_length            = null;
		$this->sql_format            = null;
		$this->sql_sample_rate       = null;
		$this->sql_channels          = null;
		$this->sql_speaker           = null;
		$this->sql_url_original      = null;
		$this->sql_url_resampled_mp3 = null;
		$this->sql_url_resampled_ogg = null;

		$this->dataBase64 = null;
		$this->data       = null;
	}


	// Destructor
	public function __destruct() {

		$this->voice_note_id     = null;
		$this->p_uuid            = null;
		$this->length            = null;
		$this->format            = null;
		$this->sample_rate       = null;
		$this->channels          = null;
		$this->speaker           = null;
		$this->url_original      = null;
		$this->url_resampled_mp3 = null;
		$this->url_resampled_ogg = null;

		$this->Ovoice_note_id     = null;
		$this->Op_uuid            = null;
		$this->Olength            = null;
		$this->Oformat            = null;
		$this->Osample_rate       = null;
		$this->Ochannels          = null;
		$this->Ospeaker           = null;
		$this->Ourl_original      = null;
		$this->Ourl_resampled_mp3 = null;
		$this->Ourl_resampled_ogg = null;

		$this->sql_voice_note_id     = null;
		$this->sql_p_uuid            = null;
		$this->sql_length            = null;
		$this->sql_format            = null;
		$this->sql_sample_rate       = null;
		$this->sql_channels          = null;
		$this->sql_speaker           = null;
		$this->sql_url_original      = null;
		$this->sql_url_resampled_mp3 = null;
		$this->sql_url_resampled_ogg = null;

		$this->dataBase64 = null;
		$this->data       = null;

		// make sure tables are safe :)
		$q = "UNLOCK TABLES;";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "voiceNote unlock tables ((".$q."))"); }
	}


	// initializes some values for a new instance (instead of when we load a previous instance)
	public function init() {
		$this->voice_note_id = shn_create_uuid("voice_note");
	}


	// load data from db
	public function load() {

		$q = "
			SELECT *
			FROM voice_note
			WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."' ;
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "voiceNote load 1 ((".$q."))"); }

		if($result != NULL && !$result->EOF) {

			$this->voice_note_id     = $result->fields['voice_note_id'];
			$this->p_uuid            = $result->fields['p_uuid'];
			$this->length            = $result->fields['length'];
			$this->format            = $result->fields['format'];
			$this->sample_rate       = $result->fields['sample_rate'];
			$this->channels          = $result->fields['channels'];
			$this->speaker           = $result->fields['speaker'];
			$this->url_original      = $result->fields['url_original'];
			$this->url_resampled_mp3 = $result->fields['url_resampled_mp3'];
			$this->url_resampled_ogg = $result->fields['url_resampled_ogg'];

			// original values for updates...
			$this->Ovoice_note_id     = $result->fields['voice_note_id'];
			$this->Op_uuid            = $result->fields['p_uuid'];
			$this->Olength            = $result->fields['length'];
			$this->Oformat            = $result->fields['format'];
			$this->Osample_rate       = $result->fields['sample_rate'];
			$this->Ochannels          = $result->fields['channels'];
			$this->Ospeaker           = $result->fields['speaker'];
			$this->Ourl_original      = $result->fields['url_original'];
			$this->Ourl_resampled_mp3 = $result->fields['url_resampled_mp3'];
			$this->Ourl_resampled_ogg = $result->fields['url_resampled_ogg'];

		} else {
			// we failed to load a de object for this person, so fail the load (indicate to person class there is no edxl for this person)
			return false;
		}
	}


	// Delete function
	public function delete() {

		// just to mysql-ready the data nodes...
		$this->sync();

		// remove from filesystem this image
		$this->unwrite();

		// delete from db
		$q = "
			DELETE FROM voice_note
			WHERE voice_note_id = ".$this->sql_voice_note_id.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person voice note delete 1 ((".$q."))"); }
	}


	// synchronize SQL value strings with public attributes
	private function sync() {

		global $global;

		// build SQL value strings

		$this->sql_voice_note_id     = ($this->voice_note_id     === null) ? "NULL" : (int)$this->voice_note_id;
		$this->sql_p_uuid            = ($this->p_uuid            === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->p_uuid)."'";
		$this->sql_length            = ($this->length            === null) ? "NULL" : (int)$this->length;
		$this->sql_format            = ($this->format            === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->format)."'";
		$this->sql_sample_rate       = ($this->sample_rate       === null) ? "NULL" : (int)$this->sample_rate;
		$this->sql_channels          = ($this->channels          === null) ? "NULL" : (int)$this->channels;
		$this->sql_speaker           = ($this->speaker           === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->speaker)."'";
		$this->sql_url_original      = ($this->url_original      === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->url_original)."'";
		$this->sql_url_resampled_mp3 = ($this->url_resampled_mp3 === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->url_resampled_mp3)."'";
		$this->sql_url_resampled_ogg = ($this->url_resampled_ogg === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->url_resampled_ogg)."'";
	}


	private function decode() {
		$this->data = base64_decode($this->dataBase64);
	}


	private function unwrite() {

		global $global;

		$webroot  = $global['approot']."www/";
		$original = $webroot.$this->url_original;
		$mp3      = $webroot.$this->url_resampled_mp3;
		$ogg      = $webroot.$this->url_resampled_ogg;

		if(!unlink($original)) {
			daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, "unable to delete file", "person voicenote unwrite 1 ((".$original."))");
		}
		if(!unlink($mp3)) {
			daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, "unable to delete file", "person voicenote unwrite 2 ((".$mp3."))");
		}
		if(!unlink($ogg)) {
			daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, "unable to delete file", "person voicenote unwrite 3 ((".$ogg."))");
		}
	}


	private function write() {

		global $global;

		// base64 to hex
		$this->decode();

		// generate path and filename portion
		$a = explode("/", $this->p_uuid);
		$filename = $a[0]."_".$a[1]; // make pl.nlm.nih.gov/person.123456 into pl.nlm.nih.gov_person.123456
		$filename = $filename."_vn".$this->voice_note_id."_"; // filename now like pl.nlm.nih.gov_person.123456_vn112233_
		$path = $global['approot']."www/tmp/plus_cache/".$filename; // path is now like /opt/pl/www/tmp/plus_cache/pl.nlm.nih.gov_person.123456_vn112233_

		// save original like /opt/pl/www/tmp/plus_cache/pl.nlm.nih.gov_person.123456_vn112233_original
		file_put_contents($path."original", $this->data);
		chmod($path."original", 0777);
		$this->url_original  = "tmp/plus_cache/".$filename."original";

		// use ffmpeg to resample the file to wav for html5 audio (supported in all browsers)
		shell_exec("ffmpeg -i ".$path."original ".$path."resampled.mp3 ;");
		shell_exec("ffmpeg -i ".$path."original ".$path."resampled.ogg ;");
		chmod($path."resampled.mp3", 0777);
		chmod($path."resampled.ogg", 0777);
		$this->url_resampled_mp3 = "tmp/plus_cache/".$filename."resampled.mp3";
		$this->url_resampled_ogg = "tmp/plus_cache/".$filename."resampled.ogg";
	}


	// save the voice note
	public function insert() {
		$this->write();
		$this->sync();
		$q = "
			INSERT INTO voice_note (
				voice_note_id,
				p_uuid,
				length,
				format,
				sample_rate,
				channels,
				speaker,
				url_original,
				url_resampled_mp3,
				url_resampled_ogg )
			VALUES (
				".$this->sql_voice_note_id.",
				".$this->sql_p_uuid.",
				".$this->sql_length.",
				".$this->sql_format.",
				".$this->sql_sample_rate.",
				".$this->sql_channels.",
				".$this->sql_speaker.",
				".$this->sql_url_original.",
				".$this->sql_url_resampled_mp3.",
				".$this->sql_url_resampled_ogg." );
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "voiceNote insert ((".$q."))"); }
	}
}



