<?php
  session_start();

  if(isset($_SESSION['id']))
    header("location: principal.php");
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema Fluxo-Caixa</title>
    <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all.css">
    <script type="text/javascript" src="extjs/ext-all.js"></script>
    <script type="text/javascript" src="app/ux/Ext.ux.plugin.FormEnter.js"></script>

    <script type="text/javascript">

   	Ext.onReady(function() {
              Ext.QuickTips.init();

			  var login = Ext.create('Ext.FormPanel', {
				  labelWidth	 : 50,
				  url			 : 'php/login.php?acao=login',
				  frame		 : true,
				  defaultType  : 'textfield',
				  monitorValid : true,
				  plugins      : [{
									  ptype: 'formenter'
								  }],
				  items		 : [{
						  fieldLabel : 'Seu E-mail',
						  vtype      : 'email',
						  name       : 'email',
						  blankText  : 'Por favor, informe o seu e-mail',
						  width      : 300,
						  allowBlank : false
				  },{
						  fieldLabel : 'Sua Senha',
						  name       : 'senha',
						  width      : 300,
						  inputType  : 'password',
						  blankText  : 'Por favor, informe a sua senha',
						  allowBlank : false
				  }],
				  buttons : [{
							   text 		: 'Entrar',
							   formBind 	: true,
							   handler    : facaLogin
						    }]
			  });

			  var win = Ext.create("Ext.Window",{
				  layout    : 'fit',
				  title     : 'Acesso ao sistema Fluxo de Caixa',
				  width     : 280,
				  height    : 140,
				  y         : 350,
				  closable  : false,
				  resizable : false,
				  draggable : false,
				  plain     : true,
				  border    : false,
				  items     : [login]
			  });

			  win.show();

			  function facaLogin() {
				  if(login.getForm().isValid())
				  {
					  login.getForm().submit({
						  method 		: 'POST',
						  waitTitle 	: 'Por favor, aguarde !!!',
						  waitMsg 	: 'Autenticado no sistema ',
						  success     : function(){
									  login.getForm().reset();
									  var redirect = 'principal.php';
									  window.location = redirect;
						  },
						  failure     : function(form, action){
									  if(action.failureType === 'server'){
										  obj = Ext.decode(action.response.responseText);
										  Ext.Msg.show({
												  title   : 'Erro no login',
												  msg     : obj.erro.motivo,
												  buttons : Ext.Msg.OK,
												  icon    : Ext.MessageBox.ERROR,
												  scope   : this,
												  width   : 150
										  });
									  }
									  else
									  {
										  Ext.Msg.alert('ERRO', 'Passe esta mensagem para o suporte: ' + action.response.responseText);
									  }
								  login.getForm().reset();
						  }
					  });
				  }
			  }

          });
    </script>
    </head>
    <body></body>
</html>
