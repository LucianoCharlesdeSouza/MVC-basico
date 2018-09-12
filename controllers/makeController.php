<?php

/**
 * Classe Make
 *
 * Responsável por criar um modelo padrão de Classe Controladora
 *
 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class makeController extends Controller
{

    public function index()
    {
        $this->loadView("make/index");
    }

    public function controller()
    {
        $this->loadView("make/controller");
    }

    public function model()
    {
        $this->loadView("make/model");
    }

    public function createModel()
    {
        if (in_array('', $this->request->all())) {
            Session::flashDanger("Preecha todos os campos!");
            redirect("/make/model");
        }

        $path = $this->request->post('path_model');
        $name = $this->request->post('name_model');
        $tableName = $this->request->post('name_table');

        $file_ = $this->nameModel($path, $name);

        if (!file_exists($file_)) {

            $this->createFileModel($name, $file_, $tableName);

            Session::flashSuccess("Model criada com Sucesso!");
            redirect("/make/model");
        }
        Session::flashDanger("Pasta Não existe, ou ja existe um Model com esse Nome!");
        redirect("/make/model");
    }

    public function createController()
    {
        if (in_array('', $this->request->all())) {
            Session::flashDanger("Preecha todos os campos!");
            redirect("/make/controller");
        }

        $path = $this->request->post('path_controller');
        $name = $this->request->post('name_controller');

        $file_ = $this->nameController($path, $name);

        $this->mkdir_r($this->nameView($path, $name));

        $folder = $this->nameView($path, $name);

        if (!file_exists($file_)) {

            $this->createFileController($name, $file_);

            if (is_dir($folder)) {

                $this->createFileViews($folder);
            }

            Session::flashSuccess("Controller criado com Sucesso!");
            redirect("/make/controller");
        }
        Session::flashDanger("Pasta Não existe, ou ja existe um Controller com esse Nome!");
        redirect("/make/controller");
    }

    private function createFileViews($folder)
    {
        $this->viewIndex($folder);
        $this->viewCreate($folder);
        $this->viewShow($folder);
        $this->viewEdit($folder);
    }

    private function createFileController($name, $file_)
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

        $this->createFile($file_, $class);
    }

    private function createFileModel($name, $file_, $tableName)
    {

        $table = str_replace('-', '_', $tableName);
        $modelClass = ucfirst($name);

        $class = "<?php" . PHP_EOL;
        $class .= "class {$modelClass} extends Model" . PHP_EOL;
        $class .= "{" . PHP_EOL;

        $class .= 'protected $table = "' . $table . '";' . PHP_EOL;
        $class .= 'public $rules = [];' . PHP_EOL;
        $class .= 'public $messages = [];' . PHP_EOL;

        $class .= "}";

        $this->createFile($file_, $class);
    }

    private function nameController($path, $name)
    {
        $controller = strtolower($name) . "Controller";

        $site = dirname(__DIR__) . '/controllers/';
        $other_path = dirname(__DIR__) . "/" . strtolower($path) . "/controllers/";

        $path_ = ($path == "site") ? $site : $other_path;

        return $path_ . $controller . ".php";
    }

    private function nameModel($path, $name)
    {
        $model_ = $name;

        $site = dirname(__DIR__) . '/models/';
        $other_path = dirname(__DIR__) . "/" . strtolower($path) . "/models/";

        $path_ = ($path == "site") ? $site : $other_path;

        return $path_ . $model_ . ".php";
    }

    private function nameView($path, $name)
    {
        $folder = strtolower($name);

        $site = dirname(__DIR__) . '/views/';
        $other_path = dirname(__DIR__) . "/" . strtolower($path) . "/views/";

        $path_ = ($path == "site") ? $site : $other_path;

        return $path_ . $folder;
    }

    private function viewIndex($folder)
    {
        $class = "<h1>INDEX => Listagem dos dados <= INDEX</h1>";

        return $this->createFile($folder . "/index.php", $class);
    }

    private function viewCreate($folder)
    {
        $class = "<h1>CREATE => Formulario de insercao <= CREATE</h1>";

        return $this->createFile($folder . "/create.php", $class);
    }

    private function viewShow($folder)
    {
        $class = "<h1>SHOW => Visualizar um Recurso <= SHOW</h1>";

        return $this->createFile($folder . "/show.php", $class);
    }

    private function viewEdit($folder)
    {
        $class = "<h1>EDIT => Formulario de edicao <= EDIT</h1>";

        return $this->createFile($folder . "/edit.php", $class);
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

    private function createFile($file_, $class)
    {
        $file = fopen($file_, "w");
        fwrite($file, utf8_encode($class));
        fclose($file);
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

}
