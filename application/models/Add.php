<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Add extends CI_model {

		public function LogLoginDate($id)
		{

            $date = date('Y-m-d');
			$vars = array(
			'login' => $date
			);

            $this->db->where('id', $id);
			$this->db->update('users', $vars);

		}

		public function AddUser($name, $mail, $md5, $phone)
		{

			$vars = array(
			'name' => $name,
            'mail' => $mail,
            'phone' => $phone,
            'passwd' => $md5
			);

			$this->db->insert('users', $vars);

		}

		public function PassReset($id, $md5)
		{

			$vars = array(
            'passwd' => $md5
			);

            $this->db->where('id', $id);
			$this->db->update('users', $vars);

		}

		public function AddSponsor($name, $image)
		{

			$vars = array(
			'name' => $name,
            'img' => $image
			);

			$this->db->insert('sponsors', $vars);

		}

		public function AddEvent($title, $date, $content, $image)
		{

			$vars = array(
			'date' => $date,
            'title' => $title,
            'image' => $image,
            'content' => $content
			);

			$this->db->insert('calendar', $vars);

		}

		public function ModEvent($id, $title, $date, $content, $image)
		{

			$vars = array(
			'title' => $title,
            'date' => $date,
            'content' => $content,
            'image' => $image
			);

            $this->db->where('id', $id);
			$this->db->update('calendar', $vars);

		}

		public function ModEventNoImage($id, $title, $date, $content)
		{

			$vars = array(
			'title' => $title,
            'date' => $date,
            'content' => $content,
			);

            $this->db->where('id', $id);
			$this->db->update('calendar', $vars);

		}

		public function ModSponsor($id, $name, $image)
		{

			$vars = array(
			'name' => $name,
            'img' => $image
			);

            $this->db->where('id', $id);
			$this->db->update('sponsors', $vars);

		}

		public function ModSponsorNoImage($id, $name)
		{

			$vars = array(
			'name' => $name
			);

            $this->db->where('id', $id);
			$this->db->update('sponsors', $vars);

		}

 		public function AddMessage($title, $image, $content)
		{

			$vars = array(
            'title' => $title,
            'image' => $image,
            'content' => $content
			);

			$this->db->insert('messages', $vars);

		}

		public function ModMessage($id, $title, $content, $image)
		{

			$vars = array(
			'title' => $title,
            'content' => $content,
            'image' => $image
			);

            $this->db->where('id', $id);
			$this->db->update('messages', $vars);

		}

		public function ModMessageNoImage($id, $title, $content)
		{

			$vars = array(
			'title' => $title,
            'content' => $content
			);

            $this->db->where('id', $id);
			$this->db->update('messages', $vars);

		}

		public function AddSlide($discription, $title, $content, $image, $active, $events, $messages, $sponsors, $wallpaper, $font, $duration)
		{

			$vars = array(
			'title' => $title,
            'discription' => $discription,
            'content' => $content,
            'image' => $image,
            'active' => $active,
            'calendar' => $events,
            'messages' => $messages,
            'sponsors' => $sponsors,
            'wallpaper' => $wallpaper,
            'fontcolor' => $font,
            'duration' => $duration
			);

            $this->db->insert('slides', $vars);

		}

		public function UpdateSlide($itemid, $discription, $title, $content, $image, $active, $events, $messages, $sponsors, $wallpaper, $font, $duration)
		{

			$vars = array(
			'title' => $title,
            'discription' => $discription,
            'content' => $content,
            'image' => $image,
            'active' => $active,
            'calendar' => $events,
            'messages' => $messages,
            'sponsors' => $sponsors,
            'wallpaper' => $wallpaper,
            'fontcolor' => $font,
            'duration' => $duration
			);

            $this->db->where('id', $itemid);
            $this->db->update('slides', $vars);

		}

		public function UpdateSlideKeepImage($itemid, $discription, $title, $content, $active, $events, $messages, $sponsors, $wallpaper, $font, $duration)
		{

			$vars = array(
			'title' => $title,
            'discription' => $discription,
            'content' => $content,
            'active' => $active,
            'calendar' => $events,
            'messages' => $messages,
            'sponsors' => $sponsors,
            'wallpaper' => $wallpaper,
            'fontcolor' => $font,
            'duration' => $duration
			);

            $this->db->where('id', $itemid);
            $this->db->update('slides', $vars);

		}

		public function AddVideoSlide($discription,$youtube, $active,$wallpaper,$duration)
		{

			$vars = array(
            'discription' => $discription,
            'content' => $youtube,
            'active' => $active,
            'wallpaper' => $wallpaper,
            'duration' => $duration
			);

            $this->db->insert('slides', $vars);

		}

		public function ModVideoSlide($id, $discription, $youtube, $active, $wallpaper, $duration)
		{

			$vars = array(
            'discription' => $discription,
            'content' => $youtube,
            'active' => $active,
            'wallpaper' => $wallpaper,
            'duration' => $duration
			);

            $this->db->where('id', $id);
            $this->db->update('slides', $vars);

		}

		public function SlideState($id,$active)
		{

			$vars = array(
			'active' => $active
			);

            $this->db->where('id', $id);
			$this->db->update('slides', $vars);

		}

		public function VideoSlideState($id,$active)
		{

			$vars = array(
			'active' => $active
			);

            $this->db->where('id', $id);
			$this->db->update('videoslides', $vars);

		}

		public function MarkasShown($id)
		{

            $now = date('Y-m-d H:i:s');
			$vars = array(
			'ran_last' => $now
			);

            $this->db->where('id', $id);
			$this->db->update('slides', $vars);

		}

		public function UpdateDigiboard($reload,$request,$execute)
		{

			$vars = array(
			'reload' => $reload,
            'update_request' => $request,
            'update_execute' => $execute
			);

            $this->db->where('id', 1);
			$this->db->update('reload', $vars);

		}

		public function AddRequest($title,$content)
		{

			$vars = array(
            'request' => $title,
            'discription' => $content
			);

			$this->db->insert('feature_requests', $vars);

		}

		public function UpdateRequest($id,$title,$content,$comment,$state)
		{

			$vars = array(
			'request' => $title,
            'discription' => $content,
            'comment' => $comment,
            'state' => $state
			);

            $this->db->where('id', $id);
			$this->db->update('feature_requests', $vars);

		}

		public function SetOrder($order, $id)
		{

			$vars = array(
			'order' => $order
			);

            $this->db->where('id', $id);
			$this->db->update('slides', $vars);

		}

		public function SaveSettings($tt_page, $tt_on)
		{

			$vars = array(
			'teletekst' => $tt_on,
            'teletekst_pagina' => $tt_page
			);

            $this->db->where('id', 1);
			$this->db->update('settings', $vars);

		}
						
	}