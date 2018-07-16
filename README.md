# MVC-basico
Estrutura básica MVC

# Funções básicas para uso

# base_url($path);
<p>Função que retorna a url do projeto</p>
<p>Uso em links css ou js: <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet"></p>

# database($key);
<p>Função que retorna um array com os indices das confg para acesso ao banco de dados!</p>
<p>Uso: $db = database();</p>
<p>echo $db['host'];</p>

# environment($key);
<p>Função que retorna o valor do indice invironment ('development/production)</p>
<p>Uso: echo environment('environment')</p>

# back_url($path = null);
<p>Função que retorna a url raiz do projeto para que quando estivermos no painel pudermos voltar a home do site por exemplo</p>
<p>Uso: <a class="navbar-brand" href="<?php echo back_url('home'); ?>">Retonar para o home</a></p>

# html($data);
<p>Função que transforma todo conteudo em html, evitando assim a execução de scripts maliciosos</p>
<p>Uso: html($js)</p>

# $this->post($field,$filter);
<p>Função usada nos controllers onde recebe dados via $_POST e, pode receber um filter e ja retornar os dados tratados e sanitizados</p>
<p>Uso : $nome = $this->post('idade','int')</p>

# $this->get($field,$filter);
<p>Função usada nos controllers onde recebe dados via $_GET e, pode receber um filter e ja retornar os dados tratados e sanitizados</p>
<p>Uso : $nome = $this->get('idade','int')</p>
