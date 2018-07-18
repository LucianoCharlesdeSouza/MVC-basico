# MVC-basico
Estrutura básica MVC

# Funções básicas para uso

# base_url($path);
<p>Função que retorna a url do projeto</p>
<p>Uso em links css ou js passados nos href ou src: base_url('/assets/css/bootstrap.min.css');</p>

# database($key);
<p>Função que retorna um array com os indices das confg para acesso ao banco de dados!</p>
<p>Uso: $db = database();</p>
<p>echo $db['host'];</p>

# environment($key);
<p>Função que retorna o valor do indice invironment ('development/production)</p>
<p>Uso: echo environment('environment')</p>

# back_url($path = null);
<p>Função que retorna a url raiz do projeto para que quando estivermos no painel pudermos voltar a home do site por exemplo</p>
<p>Uso: passados nos href de ancoras "<a>": back_url('home');</p>

# html($data);
<p>Função que transforma todo conteudo em html, evitando assim a execução de scripts maliciosos</p>
<p>Uso: html($js)</p>

# requestValue($name);
<p>Função que retorna o valor do REQUEST (GET/POST) caso exista</p>
<p>Uso:</p>
<input type='text' name='nome' value='<?php echo requestValue('nome');?>' />

# $this->post($field,$filter);
<p>Função usada nos controllers onde recebe dados via $_POST e, pode receber um filter e ja retornar os dados tratados e sanitizados</p>
<p>Uso : $idade = $this->post('idade','int')</p>

# $this->get($field,$filter);
<p>Função usada nos controllers onde recebe dados via $_GET e, pode receber um filter e ja retornar os dados tratados e sanitizados</p>
<p>Uso : $idade = $this->get('idade','int')</p>
