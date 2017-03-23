# Arquivos-de-Registro
Sistema de registro em php
<?php
	class GC{
		private $login;
		private $pass;
		private $nick;
		private $gp;
		private $vp;
		private $dpoints;
		private $onlinecs;
		private $onlinegs;
		private $schar;

		public function __construct($login, $pass, $nick) {
			$this->login = $login;
			$this->pass = $pass;
			$this->nick = $nick;
			$this->gp = 5000;
			$this->vp = 0;
			$this->dpoints = 0;
			$this->onlinecs = 0;
			$this->onlinegs = 0;
			$this->schar = 0;
		}

		public function register($database){
			$check = $database->prepare("SELECT count(*) FROM users WHERE NICK = :nick");
			$check->bindParam(":nick",$this->nick);
			$check->execute();
			if($check->fetchColumn() > 0){
				return 1;
			}
			else{
				$insert = $database->prepare("INSERT INTO users (LOGIN, PASS, NICK, GP, VP, DPOINTS, ONLINECS, ONLINEGS, SCHAR) VALUES(:login,:pass,:nick,:gp,:vp,:dpoints,:onlinecs,:onlinegs,:schar)");
				$insert->bindParam(":login",$this->login);
				$insert->bindParam(":pass",$this->pass);
				$insert->bindParam(":nick",$this->nick);
				$insert->bindParam(":gp",$this->gp);
				$insert->bindParam(":vp",$this->vp);
				$insert->bindParam(":dpoints",$this->dpoints);
				$insert->bindParam(":onlinecs",$this->onlinecs);
				$insert->bindParam(":onlinegs",$this->onlinegs);
				$insert->bindParam(":schar",$this->schar);
				$insert->execute();
				return 0;
			}
		}
	}
