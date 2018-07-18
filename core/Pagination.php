<?php

/*
 * Class Pagination
 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */

trait Pagination
{

    private $index_page = 0,
            $links = '',
            $max_page = 2,
            $max_links = 2,
            $places = [],
            $page = 'page',
            $query = '',
            $query_count = null;

    /**
     * Método que recebe o valor máximo de registros por página
     * @param $max int
     * @throws Exception
     */
    public function MaxPerPage($max)
    {
        if (!is_int($max) || !is_numeric($max)) {
            throw new Exception("Passe um valor inteiro para o máximo de registro por páginas!");
        }
        $this->max_page = (int) $max;
    }

    /**
     * Método que recebe o nome do page
     * @param $name_page string
     * @throws Exception
     */
    public function Page($name_page)
    {
        if (!is_string($name_page)) {
            throw new Exception("O nome do paginador deve ser tipo string!");
        }
        $this->page = (string) $name_page;
    }

    /**
     * Método que recebe o valor máximo de links visiveis a esquerda e direita
     * @param $maxlinks int
     * @throws Exception
     */
    public function MaxLinks($maxlinks)
    {
        if (!is_int($maxlinks) || !is_numeric($maxlinks)) {
            throw new Exception("Passe um valor para o máximo de links!");
        }
        $this->max_links = (int) $maxlinks;
    }

    /**
     * Método que recebe uma string SQL para retornar
     * os itens para a paginação
     * @param $Query string
     * @return array
     */
    public function CreatePagination($Query)
    {
        $this->getIndexPage();
        $this->query .= $Query . " LIMIT " . $this->index_page . "," . $this->max_page;
        return $this->FullQuery($this->query, $this->places);
    }

    /**
     * Método que recebe um array para usar como substitutos no Bind
     * @param array $places_values
     */
    public function Places(array $places_values)
    {
        $this->places = $places_values;
    }

    /**
     * Método que gera os links de paginação
     * @return string
     */
    public function CreateLinks()
    {
        $this->pagingNumberExceeded();
        if ($this->totalRecords() > $this->max_page) {
            $this->firstLink();
            $this->previousLink();
            $this->currentLink();
            $this->nextLink();
            $this->lastLink();
        }
        return $this->links;
    }

    /**
     * Método que recebe o valor atual da paginação
     * @return int|string
     */
    private function getPager()
    {
        $pager = filter_input(INPUT_GET, $this->page);
        return (isset($pager) ? (int) $pager : $pager . 1);
    }

    /**
     * Método que recebe objeto PDO mais o array Places,
     * gerando os Bind's
     * @param $stmt
     * @param null $Fields array
     */
    private function createBind($stmt, $Fields = null)
    {
        if ($Fields != null) {
            foreach ($Fields as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }
    }

    /**
     * Método que recebe uma string SQL,
     * podendo ou não receber também um array para as substituições
     * no Bind
     * @param $Query string
     * @param array|null $Fields
     * @return array
     */
    private function FullQuery($Query, array $Fields = null)
    {
        try {
            $stmt = $this->db->prepare($Query);
            $this->createBind($stmt, $Fields);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método que retorna o número da página
     * @return int
     */
    private function getIndexPage()
    {
        if ((($this->max_page * $this->getPager()) - $this->max_page) > 0) {
            return $this->index_page = (($this->max_page * $this->getPager()) - $this->max_page);
        }
        return $this->index_page = 0;
    }

    /**
     * Método que retorna a quantidade de registros da consulta,
     * que é usada para auxiliar na lágica da paginação
     * @return mixed
     */
    private function totalRecords()
    {
        $new_query = explode('from', strtolower($this->query));
        $this->query_count = str_replace($this->query, "select count(*) as total from " . $new_query[1], $this->query);
        $this->query_count = substr($this->query_count, 0, strpos($this->query_count, "limit"));
        $db = database();

        $fetch_mode = $db['fetch_mode'];
        return ($fetch_mode == 5) ? $this->FullQuery($this->query_count, $this->places)[0]->total : $this->FullQuery($this->query_count, $this->places)[0]['total'];
    }

    /**
     * Método que retorna o total de páginas que terá a paginação
     * @return float
     */
    private function totalPages()
    {
        return ceil($this->totalRecords() / $this->max_page);
    }

    /**
     * Método que fará o redirecionamento sempre para a última página,
     * caso o usuário passe uma valor não existente de forma manual na url
     */
    private function pagingNumberExceeded()
    {
        if (($this->getPager() > $this->totalPages() || $this->getPager() < 1) && $this->totalRecords() != 0) {
            header("Location: " . $this->ReturnPageValid($this->page) . "?" . $this->page . "=" . $this->totalPages());
        }
    }

    /**
     * Método que gera o html para o primeiro item da paginação
     */
    private function firstLink()
    {
        $this->links .= "<div class=\"col-sm-12 text-center\"><ul class=\"pagination\">";
        $first = "<li><a class=\"active\" href = \"?" . $this->page . "=1\">&laquo;</a></li>";
        $this->links .= $first;
    }

    /**
     * Método que gera o html para o item anterior da paginação atual
     */
    private function previousLink()
    {
        for ($i = $this->getPager() - $this->max_links; $i <= $this->getPager() - 1; $i++) {
            if ($i >= 1) {
                $this->links .= "<li><a href=\"?" . $this->page . "=" . $i . "\">" . $i . "</a></li>";
            }
        }
    }

    /**
     * Método que gera o html para o item atual da paginação
     */
    private function currentLink()
    {
        $this->links .= "<li class=\"active\"><span>" . $this->getPager() . "</span></li>";
    }

    /**
     * Método que gera o html para o próximo item da paginação atual
     */
    private function nextLink()
    {
        for ($i = $this->getPager() + 1; $i <= $this->getPager() + $this->max_links; $i++) {
            if ($i <= $this->totalPages()) {
                $this->links .= "<li><a href=\"?" . $this->page . "=" . $i . "\">" . $i . "</a></li>";
            }
        }
    }

    /**
     * Método que gera o html para o último item da paginação
     */
    private function lastLink()
    {
        $last = "<li><a class=\"\" href=\"?" . $this->page . "=" . $this->totalPages() . "\">&raquo;</a></li></ul></div>";
        $this->links .= $last;
    }

    /**
     * Método que retorna a url com o nome do page, porem sem o valor da paginação
     * @param $name_Pager
     * @return bool|string
     */
    private function ReturnPageValid($name_Pager)
    {
        $URL = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $url = "http://" . $URL . filter_input(INPUT_SERVER, 'REQUEST_URI');
        $https = filter_input(INPUT_SERVER, 'HTTPS');
        if (isset($https) && $https == 'on') {
            $url = "https://" . $URL . filter_input(INPUT_SERVER, 'REQUEST_URI');
        }
        return substr($url, 0, strpos($url, "?" . $name_Pager));
    }

}
