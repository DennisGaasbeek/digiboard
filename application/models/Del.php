<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Del extends CI_model {

		public function DelUser($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('users');
        }

		public function DelSponsor($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('sponsors');
        }

 		public function DelEvent($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('calendar');
        }


 		public function DelMessage($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('messages');
        }

 		public function DelSlide($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('slides');
        }

        public function DelSlidesWithWallpaper($name_decode)
		{
			$this->db->where('wallpaper', $name_decode);
			$this->db->delete('slides');
        }

 		public function DelVideoSlide($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('videoslides');
        }

	}