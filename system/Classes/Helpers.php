<?php

/**
 * Classe Helpers

 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class Helpers
{

    private static $string;
    private static $limit;
    private static $format;
    private static $data;

    /**
     * Método que valida um CPF
     * @param $Cpf
     * @return bool
     */
    public static function CPF($Cpf)
    {
        self::$data = preg_replace('/[^0-9]/', '', $Cpf);

        if (strlen(self::$data) !== 11) :
            return false;
        endif;

        $digitoA = 0;
        $digitoB = 0;

        for ($i = 0, $x = 10; $i <= 8; $i++, $x--) {
            $digitoA += self::$data[$i] * $x;
        }

        for ($i = 0, $x = 11; $i <= 9; $i++, $x--) {
            if (str_repeat($i, 11) == self::$data) {
                return false;
            }
            $digitoB += self::$data[$i] * $x;
        }

        $somaA = (($digitoA % 11) < 2) ? 0 : 11 - ($digitoA % 11);
        $somaB = (($digitoB % 11) < 2) ? 0 : 11 - ($digitoB % 11);

        if ($somaA != self::$data[9] || $somaB != self::$data[10]) {
            return false;
        }
        return true;
    }

    /**
     * Método que limita a qtd de palavras em uma string
     * @param $string
     * @param $limit
     * @param null $endWith
     * @return string
     */
    public static function limitWords($string, $limit, $endWith = null)
    {
        self::$string = strip_tags(trim($string));

        self::$limit = (int) $limit;

        $wordArray = explode(' ', self::$string);

        $numberOfWords = count($wordArray);

        $newWords = implode(' ', array_slice($wordArray, 0, self::$limit));

        $endWith = (empty($endWith) ? '...' : ' ' . $endWith);

        $Resultado = (self::$limit < $numberOfWords ? $newWords . $endWith : self::$string);

        return $Resultado;
    }

    /**
     * Método que limita a qtd de characters em uma string
     * @param $string
     * @param $limit
     * @param null $endWith
     * @param string $occurrence
     * @return string
     */
    public static function limitChars($string, $limit, $endWith = null, $occurrence = "")
    {
        self::$string = strip_tags($string);
        self::$limit = (int) $limit;

        if (strlen(self::$string) <= self::$limit) {
            return self::$string;
        }

        if ($occurrence !== "") {
            $characters = strrpos(mb_substr(self::$string, 0, self::$limit), $occurrence);
            return mb_substr(self::$string, 0, $characters) . $endWith;
        }

        $characters = mb_substr(self::$string, 0, self::$limit);
        return $characters . $endWith;
    }

    /**
     * Método que retorna uma string tratada como slug
     * @param $string
     * @return string
     */
    public static function slug($string)
    {
        self::$string = (string) $string;
        self::$string = preg_replace('/[\t\n]/', ' ', self::$string);
        self::$string = preg_replace('/\s{2,}/', ' ', self::$string);
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            '@' => '-',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '#' => '-',
            '$' => '-',
            '%' => '-',
            '&' => '-',
            '*' => '-',
            '()' => '-',
            '(' => '-',
            ')' => '-',
            '_' => '-',
            '-' => '-',
            '+' => '-',
            '=' => '-',
            '*' => '-',
            '/' => '-',
            '\\' => '-',
            '"' => '-',
            '{}' => '-',
            '{' => '-',
            '}' => '-',
            '[]' => '-',
            '[' => '-',
            ']' => '-',
            '?' => '-',
            ';' => '-',
            '.' => '-',
            ',' => '-',
            '<>' => '-',
            '°' => '-',
            'º' => '-',
            'ª' => '-',
            ':' => '-',
            '!' => '-',
            '¨' => '-',
            ' ' => '-'
        );
        self::$string = strtr(self::$string, $list);

        self::$string = preg_replace('/-{2,}/', '-', self::$string);

        self::$string = mb_strtolower(self::$string);

        return self::$string;
    }

    /**
     * Método que valida o formato de e-mail
     * @param $email
     * @return bool
     */
    public static function isMail($email)
    {
        self::$string = $email;

        self::$format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$format, self::$string)) {
            return true;
        }

        return false;
    }
}
