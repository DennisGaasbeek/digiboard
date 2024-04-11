<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Get extends CI_model {


		public function CheckAccount($user, $pass)
		{
			$this->db->from('users');
			$this->db->where('mail', $user);
			$this->db->where('passwd', $pass);
			$query = $this->db->get();
			return $query->result();
		}

		public function CheckDateAccount($user,$pass,$today)
		{
			$this->db->from('users');
			$this->db->where('mail', $user);
			$this->db->where('passwd', $pass);
            $this->db->where('login', $today);
			$query = $this->db->get();
			return $query->result();
		}

		public function CheckRecovery($input)
		{
			$this->db->from('users');
			$this->db->where('mail', $input);
			$query = $this->db->get();
			return $query->result();
		}

		public function InitRecovery($user,$name)
		{
			$this->db->from('users');
			$this->db->where('name', $name);
            $this->db->where('mail', $user);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetUsers()
		{
			$this->db->from('users');
			$query = $this->db->get();
			return $query->result();
		}

		public function GetUser($mail)
		{
			$this->db->from('users');
            $this->db->where('mail', $mail);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSlides()
		{
			$this->db->from('slides');
            $this->db->order_by('order');
			$query = $this->db->get();
			return $query->result();
		}

		public function GetVideoSlides()
		{
			$this->db->from('videoslides');
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSlide($id)
		{
			$this->db->from('slides');
            $this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetActiveSlides()
		{
			$this->db->from('slides');
            $this->db->where('active', 1);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSelectedSlides()
		{
			$this->db->from('slides');
            $this->db->where('active', 1);
            $this->db->order_by('ran_last');
            $this->db->order_by('order');
            $this->db->limit(1);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSelectedVideoSlides()
		{
			$this->db->from('videoslides');
            $this->db->where('active', 1);
            $this->db->order_by('ran_last');
            $this->db->order_by('order');
            $this->db->limit(1);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSponsors()
		{
			$this->db->from('sponsors');
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSponsor($id)
		{
			$this->db->from('sponsors');
            $this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetEvents()
		{
			$this->db->from('calendar');
            $this->db->order_by('date', DESC);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetEvent($id)
		{
			$this->db->from('calendar');
            $this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetValidEvents()
		{
            $today = date('Y-m-d');
			$this->db->from('calendar');
            $this->db->where('date >=', $today);
            $this->db->order_by('date', DESC);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetMessages()
		{
			$this->db->from('messages');
            $this->db->order_by('id', DESC);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetMessage($id)
		{
			$this->db->from('messages');
            $this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetSettings()
		{
			$this->db->from('settings');
            $this->db->where('id', 1);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetReload()
		{
			$this->db->from('reload');
            $this->db->where('id', 1);
			$query = $this->db->get();
			return $query->result();
		}

		public function GetRequests()
		{
			$this->db->from('feature_requests');
			$query = $this->db->get();
			return $query->result();
		}

		public function GetRequest($id)
		{
			$this->db->from('feature_requests');
            $this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

	
	}