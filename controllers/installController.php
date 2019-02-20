<?php

class installController extends Controller
{

    private $error;

    public function index()
    {
        $this->loadView("make/install");
    }

    public function app_key()
    {
        $data = [];

        $key = md5(mt_rand(0, 999999) . time() . date("YmdHms"));
        $data['retorno'] = $key;

        echo json_encode($data);
        exit();
    }

    public function setup()
    {
        $data = [];

        $path_config = dirname(__DIR__) . '/config/';

        $this->createFile($path_config, "app.php", $this->createFileApp());
        $this->createFile($path_config, "mail.php", $this->createFileMail());
        $this->createFile($path_config, "database.php", $this->createFileDataBase());

        $connection = [
            'database' => $this->request->post('database_Name'),
            'host' => $this->request->post('database_Host'),
            'username' => $this->request->post('database_UserName')
        ];


        if (!in_array('', $connection)) {
            $connection['password'] = $this->request->post('database_UserPassword');
            if (!$this->connect($connection)) {
                $data['retorno'] = Alert::AjaxInfo($this->error);
            } else {
                $this->createHomeController('home');
                $data['retorno'] = Alert::AjaxSuccess("\o/ tudo certo, agora basta <strong>excluir</strong> o arquivo <strong>installController.php</strong> do projeto para que não modifique mais as configurações iniciais!<p><strong>Aguarde redirecionamento...</strong></p>");
                $data['redirect'] = Alert::AjaxRedirect("/home", 5000);
            }
        } else {
            $data['retorno'] = Alert::AjaxInfo("Preencha os campos da aba DataBase para podermos nos conectar ao SERVER e criarmos o banco!");
            $data['database_empty'] = true;
        }


        echo json_encode($data);
        exit();
    }

    public function continueHome()
    {
        $this->createHomeController('home');
        $data['retorno'] = Alert::AjaxSuccess("\o/ tudo certo, agora basta <strong>excluir</strong> o arquivo <strong>installController.php</strong> do projeto para que não modifique mais as configurações iniciais!<p><strong>Aguarde redirecionamento...</strong></p>");
        $data['redirect'] = Alert::AjaxRedirect("/home", 5000);
        echo json_encode($data);
        exit();
    }

    private function createHomeController($name)
    {
        $path_config = dirname(__DIR__) . '/controllers/';
        $this->createFile($path_config, "{$name}Controller.php", $this->createFileHomeController($name));
//        $this->createFileViews($name);
        $this->mkdir_r($this->nameView($name) . "/{$name}");
        $this->createFileViews($this->nameView(), $name);
    }

    private function createFileViews($path_config, $folder)
    {
        $this->viewIndex($path_config, $folder);
        $this->viewCreate($path_config, $folder);
        $this->viewShow($path_config, $folder);
        $this->viewEdit($path_config, $folder);
    }

    private function nameView()
    {
        $path_ = dirname(__DIR__) . '/views/';

        return $path_;
    }

    private function viewIndex($path_config, $folder)
    {
        $class = "";
        $class .= "<style>" . PHP_EOL;
        $class .= '.full-height {' . PHP_EOL;
        $class .= "height: 80vh;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.flex-center {' . PHP_EOL;
        $class .= "align-items: center;" . PHP_EOL;
        $class .= "display: flex;" . PHP_EOL;
        $class .= "justify-content: center;" . PHP_EOL;
        $class .= " background-color: #fff;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.position-ref {' . PHP_EOL;
        $class .= "position: relative;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.content {' . PHP_EOL;
        $class .= "text-align: center;" . PHP_EOL;
        $class .= "color: #636b6f;" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        $class .= '.content p{' . PHP_EOL;
        $class .= "font-size: 2em;" . PHP_EOL;
        $class .= "color: #636b6f;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.title {' . PHP_EOL;
        $class .= "font-size: 6em;" . PHP_EOL;
        $class .= "text-shadow: 0.0em -0.0em 0.1em #0065ff;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.links > a {' . PHP_EOL;
        $class .= "color: #636b6f;" . PHP_EOL;
        $class .= "padding: 0 25px;" . PHP_EOL;
        $class .= "font-size: 12px;" . PHP_EOL;
        $class .= "font-weight: 600;" . PHP_EOL;
        $class .= "letter-spacing: .1rem;" . PHP_EOL;
        $class .= "text-decoration: none;" . PHP_EOL;
        $class .= "text-transform: uppercase;" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        $class .= '.links > a:hover{' . PHP_EOL;
        $class .= "text-shadow: 0.0em -0.0em 0.1em green;" . PHP_EOL;
        $class .= "}" . PHP_EOL;

        $class .= '.m-b-md {' . PHP_EOL;
        $class .= " margin-bottom: 30px;" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        $class .= "</style>" . PHP_EOL;
        $class .= '<div class = "flex-center position-ref full-height">' . PHP_EOL;

        $class .= '<div class = "content">' . PHP_EOL;
        $class .= "<p>&copy;" . PHP_EOL;
        $class .= "My App in MVC 2017-2018</p>" . PHP_EOL;
        $class .= '<div class = "title m-b-md">' . PHP_EOL;
        $class .= "Grupo ++PHP" . PHP_EOL;
        $class .= "</div>" . PHP_EOL;

        $class .= '<div class = "links">' . PHP_EOL;
        $class .= '<a href = "https://github.com/LucianoCharlesdeSouza" target = "_blank">GitHub</a>' . PHP_EOL;
        $class .= '<a href = "https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber" target = "_blank">YouTube</a>' . PHP_EOL;
        $class .= ' <a href = "<?php echo base_url("/make") ?>" target = "_blank">Make Controller/View and Models</a>' . PHP_EOL;
        $class .= '</div>' . PHP_EOL;
        $class .= '</div>' . PHP_EOL;
        $class .= '</div>' . PHP_EOL;

        return $this->createFile($path_config, $folder . "/index.php", $class);
    }

    private function viewCreate($path_config, $folder)
    {
        $class = "<h1>CREATE => Formulario de insercao <= CREATE</h1>";

        return $this->createFile($path_config, $folder . "/create.php", $class);
    }

    private function viewShow($path_config, $folder)
    {
        $class = "<h1>SHOW => Visualizar um Recurso <= SHOW</h1>";

        return $this->createFile($path_config, $folder . "/show.php", $class);
    }

    private function viewEdit($path_config, $folder)
    {
        $class = "<h1>EDIT => Formulario de edicao <= EDIT</h1>";

        return $this->createFile($path_config, $folder . "/edit.php", $class);
    }

    private function mkdir_r($dirName, $rights = 0777)
    {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir .= $part . '/';
            if (!is_dir($dir) && strlen($dir) > 0 && !file_exists($dir))
                mkdir($dir, $rights);
        }
    }

    private function createFile($path_config, $nameFile, $class)
    {
        $file = fopen($path_config . $nameFile, "w");
        fwrite($file, utf8_encode($class));
        fclose($file);
    }

    private function createFileHomeController($name)
    {
        $class = "<?php" . PHP_EOL;
        $class .= "class {$name}Controller extends Controller" . PHP_EOL;
        $class .= "{" . PHP_EOL;

        $class .= $this->addConstruct();
        $class .= $this->addIndex($name);
        $class .= $this->addCreate($name);
        $class .= $this->addStore();
        $class .= $this->addShow($name);
        $class .= $this->addEdit($name);
        $class .= $this->addUpdate();
        $class .= $this->addDelete();

        $class .= "}";

        return $class;
    }

    private function addConstruct()
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Construtor da classe" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= "public function __construct()" . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= 'parent::__construct();' . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addIndex($folder)
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Exibe uma listagem do recurso" . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= "*@return View" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= "public function index()" . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= '$data = [];' . PHP_EOL;
        $class .= '$data["title"]= "index";' . PHP_EOL;
        $class .= '$this->loadTemplate("' . $folder . '/index",$data);' . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addCreate($folder)
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Exibe o formulario para criar um novo recurso." . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= "*@return View" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= "public function create()" . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= '$data = [];' . PHP_EOL;
        $class .= '$data["title"]= "create";' . PHP_EOL;
        $class .= '$this->loadTemplate("' . $folder . '/create",$data);' . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addStore()
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Captura os dados do formulario para manipular" . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= "*@return msg/redirect" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= "public function store()" . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addShow($folder)
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Exibe um recurso especifico." . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= '* @param  int $id' . PHP_EOL;
        $class .= "*@return View" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= 'public function show($id)' . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= '$data = [];' . PHP_EOL;
        $class .= '$data["title"]= "show";' . PHP_EOL;
        $class .= '$this->loadTemplate("' . $folder . '/show",$data);' . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addEdit($folder)
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Exibe o formulario para editar um recurso especifico." . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= '* @param  int $id' . PHP_EOL;
        $class .= "*@return View" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= 'public function edit($id)' . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= '$data = [];' . PHP_EOL;
        $class .= '$data["title"]= "edit";' . PHP_EOL;
        $class .= '$this->loadTemplate("' . $folder . '/edit",$data);' . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addUpdate()
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Atualiza um recurso especifico." . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= '* @param  int $id' . PHP_EOL;
        $class .= "*@return msg/redirect" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= 'public function update($id)' . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function addDelete()
    {
        $class = '';
        $class .= "/**" . PHP_EOL;
        $class .= "* Exclui um recurso especifico." . PHP_EOL;
        $class .= "*" . PHP_EOL;
        $class .= '* @param  int $id' . PHP_EOL;
        $class .= "*@return msg/redirect" . PHP_EOL;
        $class .= "*/" . PHP_EOL;

        $class .= 'public function delete($id)' . PHP_EOL;
        $class .= "{" . PHP_EOL;
        $class .= "}" . PHP_EOL;
        return $class;
    }

    private function createFileApp()
    {
        $class = "<?php" . PHP_EOL;
        $class .= "return [" . PHP_EOL;
        $class .= "'app_name' => '" . $this->request->post('app_Name') . "'," . PHP_EOL;
        $class .= "'app_key' => '" . $this->request->post('app_Key') . "'," . PHP_EOL;
        $class .= "'app_time_blocked' => 59," . PHP_EOL;
        $class .= "'recover_token_in' => 2," . PHP_EOL;     
        $class .= "'app_time_zone' => 'America/Sao_Paulo'" . PHP_EOL;
        $class .= "];";
        return $class;
    }

    private function createFileDataBase()
    {
        $class = "<?php" . PHP_EOL;
        $class .= "return [" . PHP_EOL;
        $class .= "/*" . PHP_EOL;
        $class .= " ----++ PHP------------------------------------------------------------------" . PHP_EOL;
        $class .= "| Status do aplicativo" . PHP_EOL;
        $class .= "| ---------------------------------------L-U-C-I-A-N-O---C-H-A-R-L-E-S-------" . PHP_EOL;
        $class .= " | development/production" . PHP_EOL;
        $class .= " |" . PHP_EOL;
        $class .= " | Aqui estao as configuracoes de conexoes de banco de dados para seu aplicativo." . PHP_EOL;
        $class .= " | Assim sera recuperado os dados de acesso ao banco de dados" . PHP_EOL;
        $class .= "| conforme o indice environment." . PHP_EOL;
        $class .= "|" . PHP_EOL;
        $class .= '*/' . PHP_EOL;
        $class .= "'environment' => environment('environment')," . PHP_EOL;
        $class .= '/*' . PHP_EOL;
        $class .= '| ---------------------------------------------------------------------------' . PHP_EOL;
        $class .= "| Conexoes de banco de dados                    GRUPO ++ PHP" . PHP_EOL;
        $class .= "| ---------------------------------------------------------------------------" . PHP_EOL;
        $class .= "|" . PHP_EOL;
        $class .= "| Aqui estao as configuracoes de conexoes de banco de dados para seu aplicativo." . PHP_EOL;
        $class .= "|" . PHP_EOL;
        $class .= "| Portanto, verifique se voce tem o driver para o banco de dados" . PHP_EOL;
        $class .= "| instalado em sua maquina antes de comecar o desenvolvimento." . PHP_EOL;
        $class .= "|" . PHP_EOL;
        $class .= '*/' . PHP_EOL;
        $class .= "'connections' => [" . PHP_EOL;
        $class .= "'development' => [" . PHP_EOL;
        $class .= "'host' => '" . $this->request->post('database_Host') . "'," . PHP_EOL;
        $class .= "'port' => " . $this->request->post('database_Port') . "," . PHP_EOL;
        $class .= "'database' => '" . $this->request->post('database_Name') . "'," . PHP_EOL;
        $class .= "'username' => '" . $this->request->post('database_UserName') . "'," . PHP_EOL;
        $class .= "'password' => '" . $this->request->post('database_UserPassword') . "'," . PHP_EOL;
        $class .= "'unix_socket' => null," . PHP_EOL;
        $class .= "'options' => [" . PHP_EOL;
        $class .= 'PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",' . PHP_EOL;
        $class .= " PDO::ATTR_PERSISTENT => true" . PHP_EOL;
        $class .= "]," . PHP_EOL;
        $class .= "'errmode' => PDO::ERRMODE_EXCEPTION," . PHP_EOL;
        $class .= "'fetch_mode' => " . $this->request->post('pdo_fetchMode') . PHP_EOL;
        $class .= "]," . PHP_EOL;
        $class .= "'production' => [" . PHP_EOL;
        $class .= "'host' => 'localhost'," . PHP_EOL;
        $class .= "'port' => 3306," . PHP_EOL;
        $class .= "'database' => 'grupo++'," . PHP_EOL;
        $class .= "'username' => 'root'," . PHP_EOL;
        $class .= "'password' => ''," . PHP_EOL;
        $class .= "'unix_socket' => null," . PHP_EOL;
        $class .= "'options' => [" . PHP_EOL;
        $class .= 'PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",' . PHP_EOL;
        $class .= "PDO::ATTR_PERSISTENT => true" . PHP_EOL;
        $class .= "]," . PHP_EOL;
        $class .= "'errmode' => PDO::ERRMODE_EXCEPTION," . PHP_EOL;
        $class .= "'fetch_mode' => PDO::FETCH_OBJ" . PHP_EOL;
        $class .= "]" . PHP_EOL;
        $class .= "]" . PHP_EOL;
        $class .= "];";
        return $class;
    }

    private function createFileMail()
    {
        $class = "<?php" . PHP_EOL;
        $class .= "return [" . PHP_EOL;
        $class .= "'mail_enviado_por' => app('app_name')," . PHP_EOL;
        $class .= "'mail_nomedestinatario' => app('app_name')," . PHP_EOL;
        $class .= "'mail_emaildestinatario' => '" . $this->request->post('mail_UserName') . "'," . PHP_EOL;
        $class .= "'mail_host' => '" . $this->request->post('mail_Host') . "'," . PHP_EOL;
        $class .= "'mail_smtpauth' => " . $this->request->post('mail_smtpAuth') . "," . PHP_EOL;
        $class .= "'mail_username' => '" . $this->request->post('mail_UserName') . "'," . PHP_EOL;
        $class .= "'mail_password' => '" . $this->request->post('mail_UserPassword') . "'," . PHP_EOL;
        $class .= "'mail_smtpsecure' => '" . $this->request->post('mail_smtpSecure') . "'," . PHP_EOL;
        $class .= "'mail_port' => " . $this->request->post('mail_Port') . "," . PHP_EOL;
        $class .= "'mail_charset' => 'UTF-8'," . PHP_EOL;
        $class .= "'mail_smtpoptions' => [" . PHP_EOL;
        $class .= "'ssl' => [" . PHP_EOL;
        $class .= "'verify_peer' => false," . PHP_EOL;
        $class .= "'verify_peer_name' => false," . PHP_EOL;
        $class .= "'allow_self_signed' => true" . PHP_EOL;
        $class .= "]" . PHP_EOL;
        $class .= "]," . PHP_EOL;
        $class .= "'mail_smtpdebug' => 0" . PHP_EOL;
        $class .= "];";
        return $class;
    }

    private function connect(array $data)
    {
        try {
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => true
            ];

            $conn = new PDO("mysql:host=" . $data['host'], $data['username'], $data['password'], $options);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $sql = "CREATE DATABASE IF NOT EXISTS " . $data['database'] . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
            if ($conn->exec($sql)) {
                return true;
            }
            $this->error = "A Base de Dados <strong>{$data['database']}</strong> ja existe!
                <p>Continuar com ela ou criar outra?
                <button class='btn btn-success continuar'>Continuar</button>
                <button class='btn btn-primary criar_outra'>Criar outra</button>
                </p>";
//            $sql = "use musicDB";
//            $conn->exec($sql);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

}
