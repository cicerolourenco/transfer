<?php

namespace admin;

class Controller_logout extends \Controller
{
	public function show_index() 
	{
		\UsuarioCMS::encerra_sessao();
	}
}