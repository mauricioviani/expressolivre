<?php
	/**************************************************************************\
	* ExpressoMail Offline login                                                         *
	* http://www.egroupware.org                                                *
	* Originaly written by Dan Kuykendall <seek3r@phpgroupware.org>            *
	*                      Joseph Engo    <jengo@phpgroupware.org>             *
	* Updated by Nilton Emilio Buhrer Neto <niltonneto@celepar.pr.gov.br>      *
	*  This program is free software; you can redistribute it and/or modify it *
	*  under the terms of the GNU General Public License as published by the   *
	*  Free Software Foundation; either version 2 of the License, or (at your  *
	*  option) any later version.                                              *
	\**************************************************************************/
ini_set("display_errors","1");
	$phpgw_info = array();
	$submit = False;			// set to some initial value

	$GLOBALS['phpgw_info']['flags'] = array(
		'disable_Template_class' => True,
		'login'                  => True,
		'currentapp'             => 'expressoMail1_2',
		'noheader'               => True
	);

	include('../header.inc.php');

//	$GLOBALS['phpgw_info']['server']['template_dir'] = PHPGW_SERVER_ROOT . '/phpgwapi/templates/' . $GLOBALS['phpgw_info']['login_template_set'];
	$tmpl = CreateObject('phpgwapi.Template', 'templates/default');

	// read the images from the login-template-set, not the (maybe not even set) users template-set
	$GLOBALS['phpgw_info']['user']['preferences']['common']['template_set'] = $GLOBALS['phpgw_info']['login_template_set'];

	$tmpl->set_file(array('login_form' => 'login_offline.tpl'));

	# Apache + mod_ssl style SSL certificate authentication
	# Certificate (chain) verification occurs inside mod_ssl
	/*if($GLOBALS['phpgw_info']['server']['auth_type'] == 'sqlssl' && isset($_SERVER['SSL_CLIENT_S_DN']) && !isset($_GET['cd']))
	{
		# an X.509 subject looks like:
		# /CN=john.doe/OU=Department/O=Company/C=xx/Email=john@comapy.tld/L=City/
		# the username is deliberately lowercase, to ease LDAP integration
		$sslattribs = explode('/',$_SERVER['SSL_CLIENT_S_DN']);
		# skip the part in front of the first '/' (nothing)
		while($sslattrib = next($sslattribs))
		{
			list($key,$val) = explode('=',$sslattrib);
			$sslattributes[$key] = $val;
		}

		if(isset($sslattributes['Email']))
		{
			$submit = True;

			# login will be set here if the user logged out and uses a different username with
			# the same SSL-certificate.
			if(!isset($_POST['login'])&&isset($sslattributes['Email']))
			{
				$login = $sslattributes['Email'];
				# not checked against the database, but delivered to authentication module
				$passwd = $_SERVER['SSL_CLIENT_S_DN'];
			}
		}
		unset($key);
		unset($val);
		unset($sslattributes);
	}*/

	//if(isset($passwd_type) || $_POST['submitit_x'] || $_POST['submitit_y'] || $submit)
	//{
///// 	In�cio - C�digo tempor�rio: Para renomea��o de login com organiza��o para sem. //////
/*		$common = CreateObject('phpgwapi.common');
		$ldap_conn = $common->ldapConnect();
		$justthese = array("uid");
		$filter="(&(phpgwAccountType=u)(uid=".$_POST['user']."))";
		$ldap_search = ldap_search($ldap_conn, $GLOBALS['phpgw_info']['server']['ldap_context'], $filter, $justthese);
		$ldap_info 	 = ldap_get_entries($ldap_conn, $ldap_search);
		if ($ldap_info['count'] != 0) // Verifica se o login existe sem organiza��o.
		{
			$_POST['login'] = $_POST['user'];
		}
		ldap_close($ldap_conn);*/
/// 	Fim - C�digo tempor�rio: Para renomea��o de login com organiza��o para sem. //////
		/*if(getenv('REQUEST_METHOD') != 'POST' && $_SERVER['REQUEST_METHOD'] != 'POST' &&
			!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['SSL_CLIENT_S_DN']))
		{
			$GLOBALS['phpgw']->redirect($GLOBALS['phpgw']->link('/login.php','cd=5'));
		}*/
		
		// don't get login data again when $submit is true
		/*if($submit == false)
		{
			$login = $_POST['login'];
		}
		
		if(strstr($login,'@') === False && isset($_POST['logindomain']))
		{
			$login .= '@' . $_POST['logindomain'];
		}
		elseif(!isset($GLOBALS['phpgw_domain'][$GLOBALS['phpgw_info']['user']['domain']]))
		{
			$login .= '@'.$GLOBALS['phpgw_info']['server']['default_domain'];
		}
		$GLOBALS['sessionid'] = $GLOBALS['phpgw']->session->create(strtolower($login),$passwd,$passwd_type,'u');

		if(!isset($GLOBALS['sessionid']) || ! $GLOBALS['sessionid'])
		{
			$GLOBALS['phpgw']->redirect($GLOBALS['phpgw_info']['server']['webserver_url'] . '/login.php?cd=' . $GLOBALS['phpgw']->session->cd_reason);
		}
		else
		{
			if ($_POST['lang'] && preg_match('/^[a-z]{2}(-[a-z]{2}){0,1}$/',$_POST['lang']) &&
			    $_POST['lang'] != $GLOBALS['phpgw_info']['user']['preferences']['common']['lang'])
			{
				$GLOBALS['phpgw']->preferences->add('common','lang',$_POST['lang'],'session');
			}

			if(!$GLOBALS['phpgw_info']['server']['disable_autoload_langfiles'])
			{
				$GLOBALS['phpgw']->translation->autoload_changed_langfiles();
			}
			$forward = isset($_GET['phpgw_forward']) ? urldecode($_GET['phpgw_forward']) : @$_POST['phpgw_forward'];
			if (!$forward)
			{
				$extra_vars['cd'] = 'yes';
				$forward = '/home.php';
			}
			else
			{
				list($forward,$extra_vars) = explode('?',$forward,2);
			}
			if ($GLOBALS['phpgw_info']['server']['use_https'] != 2)
			{
				$forward = 'http://'.$_SERVER['HTTP_HOST'].($GLOBALS['phpgw']->link($forward.'?cd=yes'));
				echo "<script language='Javascript1.3'>location.href='".$forward."'</script>";
			}
			else
			{
				$GLOBALS['phpgw']->redirect_link($forward,$extra_vars);
			}
		}
	}
	else
	{*/
		// !!! DONT CHANGE THESE LINES !!!
		// If there is something wrong with this code TELL ME!
		// Commenting out the code will not fix it. (jengo)
		/*if(isset($_COOKIE['last_loginid']))
		{
			$accounts = CreateObject('phpgwapi.accounts');
			$prefs = CreateObject('phpgwapi.preferences', $accounts->name2id($_COOKIE['last_loginid']));

			if($prefs->account_id)
			{
				$GLOBALS['phpgw_info']['user']['preferences'] = $prefs->read_repository();
			}
		}
		if ($_GET['lang'])
		{
			$GLOBALS['phpgw_info']['user']['preferences']['common']['lang'] = $_GET['lang'];
		}
		elseif(!isset($_COOKIE['last_loginid']) || !$prefs->account_id)
		{
			// If the lastloginid cookies isn't set, we will default to the first language,
			// the users browser accepts.
			list($lang) = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			/*
			if(strlen($lang) > 2)
			{
				$lang = substr($lang,0,2);
			}
			*/
			/*$GLOBALS['phpgw_info']['user']['preferences']['common']['lang'] = $lang;
		}*/
		#print 'LANG:' . $GLOBALS['phpgw_info']['user']['preferences']['common']['lang'] . '<br>';

		$GLOBALS['phpgw']->translation->init();	// this will set the language according to the (new) set prefs
		$GLOBALS['phpgw']->translation->add_app('login');
		$GLOBALS['phpgw']->translation->add_app('loginscreen');
		if(lang('loginscreen_message') == 'loginscreen_message*')
		{
			$GLOBALS['phpgw']->translation->add_app('loginscreen','en');	// trying the en one
		}
		if(lang('loginscreen_message') != 'loginscreen_message*')
		{
			$tmpl->set_var('lang_message',stripslashes(lang('loginscreen_message')));
		}
	//}

/*	if($GLOBALS['phpgw_info']['server']['use_prefix_organization'])
	{
		$organization_select = "<tr><td width=\"66\" class=\"loginLabel\">";
		$organization_select .= lang("organization").":</td>";
		$organization_select .="<td width=\"135\">";											
		$organization_select .="<select name=\"organization\">\n";		
		
		$obj_organization = CreateObject('phpgwapi.sector_search_ldap');
		$organizations = $obj_organization->organization_search($GLOBALS['phpgw_info']['server']['ldap_context']);

        $organizations_count = count($organizations);
		for ($i=0; $i<$organizations_count; ++$i)
		{
			$tmp_array[strtolower($organizations[$i])] = $organizations[$i];	
		}
		
		$arrayOrganization = $tmp_array;		
		ksort($arrayOrganization);
		
		foreach($arrayOrganization
			 as $organization_name => $organization_vars)
		{
			$organization_select .= '<option value="' . $organization_name . '"';

			if($organization_name == $_COOKIE['last_organization'])
			{
				$organization_select .= ' selected';
			}
			$organization_select .= '>' . $organization_vars . "</option>\n";
		}
		$organization_select .= "</select>\n";
		$organization_select .="</td><td>&nbsp;</td></tr>";
		$tmpl->set_var('select_organization',$organization_select);
	}*/
		
	/*$domain_select = '&nbsp;';
	$last_loginid = $_COOKIE['last_loginid'];
	if($GLOBALS['phpgw_info']['server']['show_domain_selectbox'])
	{
		$domain_select = "<select name=\"logindomain\">\n";
		foreach($GLOBALS['phpgw_domain'] as $domain_name => $domain_vars)
		{
			$domain_select .= '<option value="' . $domain_name . '"';

			if($domain_name == $_COOKIE['last_domain'])
			{
				$domain_select .= ' selected';
			}
			$domain_select .= '>' . $domain_name . "</option>\n";
		}
		$domain_select .= "</select>\n";
	}
	elseif($last_loginid !== '')
	{
		reset($GLOBALS['phpgw_domain']);
		list($default_domain) = each($GLOBALS['phpgw_domain']);

		if($_COOKIE['last_domain'] != $default_domain && !empty($_COOKIE['last_domain']))
		{
			$last_loginid .= '@' . $_COOKIE['last_domain'];
		}
	}
	$tmpl->set_var('select_domain',$domain_select);*/

	/*foreach($_GET as $name => $value)
	{
		if(preg_match('/phpgw_/',$name))
		{
			$extra_vars .= '&' . $name . '=' . urlencode($value);
		}
	}

	if($extra_vars)
	{
		$extra_vars = '?' . substr($extra_vars,1);
	}*/

	/********************************************************\
	* Check is the registration app is installed, activated  *
	* And if the register link must be placed                *
	\********************************************************/
	
	/*$cnf_reg = createobject('phpgwapi.config','registration');
	$cnf_reg->read_repository();
	$config_reg = $cnf_reg->config_data;

	if($config_reg['enable_registration']=='True' && $config_reg['register_link']=='True')
	{
		$reg_link='&nbsp;<a href="registration/">'.lang('Not a user yet? Register now').'</a><br/>';
	}*/

	$GLOBALS['phpgw_info']['server']['template_set'] = $GLOBALS['phpgw_info']['login_template_set'];

	$tmpl->set_var('register_link',$reg_link);
	$tmpl->set_var('charset',$GLOBALS['phpgw']->translation->charset());
	$tmpl->set_var('login_url', $GLOBALS['phpgw_info']['server']['webserver_url'] . '/login.php' . $extra_vars);
	$tmpl->set_var('registration_url',$GLOBALS['phpgw_info']['server']['webserver_url'] . '/registration/');
	$tmpl->set_var('version',$GLOBALS['phpgw_info']['server']['versions']['phpgwapi']);
	//$tmpl->set_var('cd',check_logoutcode($_GET['cd']));
	$tmpl->set_var('cookie',$last_loginid);
	//david
	$tmpl->set_var('teste_compatibilidade',$GLOBALS['phpgw_info']['server']['teste_compatibilidade']);

	$tmpl->set_var('lang_username',lang('username'));
	$tmpl->set_var('lang_password',lang('password'));
	$tmpl->set_var('lang_login',lang('login'));

	$tmpl->set_var('website_title', $GLOBALS['phpgw_info']['server']['site_title']);
	$tmpl->set_var('template_set',$GLOBALS['phpgw_info']['login_template_set']);
	$tmpl->set_var('bg_color',($GLOBALS['phpgw_info']['server']['login_bg_color']?$GLOBALS['phpgw_info']['server']['login_bg_color']:'FFFFFF'));
	$tmpl->set_var('bg_color_title',($GLOBALS['phpgw_info']['server']['login_bg_color_title']?$GLOBALS['phpgw_info']['server']['login_bg_color_title']:'486591'));

	if($GLOBALS['phpgw_info']['server']['use_frontend_name'])
		$tmpl->set_var('frontend_name', " - ".$GLOBALS['phpgw_info']['server']['use_frontend_name']);

	if (substr($GLOBALS['phpgw_info']['server']['login_logo_file'],0,4) == 'http')
	{
		$var['logo_file'] = $GLOBALS['phpgw_info']['server']['login_logo_file'];
	}
	else
	{
		$var['logo_file'] = $GLOBALS['phpgw']->common->image('phpgwapi',$GLOBALS['phpgw_info']['server']['login_logo_file']?$GLOBALS['phpgw_info']['server']['login_logo_file']:'logo');
	}
	$var['logo_url'] = $GLOBALS['phpgw_info']['server']['login_logo_url']?$GLOBALS['phpgw_info']['server']['login_logo_url']:'http://www.eGroupWare.org';
	if (substr($var['logo_url'],0,4) != 'http')
	{
		$var['logo_url'] = 'http://'.$var['logo_url'];
	}
	$var['logo_title'] = $GLOBALS['phpgw_info']['server']['login_logo_title']?$GLOBALS['phpgw_info']['server']['login_logo_title']:'www.eGroupWare.org';
	$tmpl->set_var($var);

	if (@$GLOBALS['phpgw_info']['server']['login_show_language_selection'])
	{
		$select_lang = '<select name="lang" onchange="'."location.href=location.href+(location.search?'&':'?')+'lang='+this.value".'">';
		$langs = $GLOBALS['phpgw']->translation->get_installed_langs();
		uasort($langs,'strcasecmp');
		foreach ($langs as $key => $name)	// if we have a translation use it
		{
			$select_lang .= "\n\t".'<option value="'.$key.'"'.($key == $GLOBALS['phpgw_info']['user']['preferences']['common']['lang'] ? ' selected="1"' : '').'>'.$name.'</option>';
		}
		$select_lang .= "\n</select>\n";
		$tmpl->set_var(array(
			'lang_language' => lang('Language'),
			'select_language' => $select_lang,
		));
	}
	else
	{
		$tmpl->set_block('login_form','language_select');
		$tmpl->set_var('language_select','');
	}
	
	if (count($GLOBALS['phpgw_info']['server']['login_logo_file']) > 0) {
		$logo_config = $GLOBALS['phpgw_info']['server']['login_logo_file'];
		$logo_config = preg_replace('/phpgwapi\//','../phpgwapi/',$logo_config);
		$tmpl->set_var('logo_config',$logo_config);	
	}
		else
			$tmpl->set_var('logo_config','<a title="Governo do Paran&aacute" href="http://www.pr.gov.br" target="_blank"><img src="../phpgwapi/templates/'.$GLOBALS['phpgw_info']['login_template_set'].'/images/logo_governo.gif" border="0"></a></td>
			<td><div align="center"><font color="#9a9a9a" face="Verdana, Arial, Helvetica, sans-serif" size="1">
	<a title="Celepar Inform&aacute;tica do Paran&aacute;" target="_blank" href="http://www.celepar.pr.gov.br/">
	<img src="../phpgwapi/templates/'.$GLOBALS['phpgw_info']['login_template_set'].'/images/logo_celepar.gif" border="0"></a>');
	
/*foreach ($GLOBALS['phpgw_info']['user'] as $indice => $valor)
					echo "$indice > $valor <br>";
					exit(0);*/
	$tmpl->set_var('autocomplete', ($GLOBALS['phpgw_info']['server']['autocomplete_login'] ? 'autocomplete="off"' : ''));

	$tmpl->pfp('loginout','login_form');
?>
