<?php
function floatPost($float){
    return str_replace(",",".",str_replace(".","",$float));
}

function limparPontuacao($string){
    return str_replace("-","",str_replace(".","",str_replace("(","",str_replace(")","",str_replace(" ","",$string)))));
}

function nullIfEmpty($value) {
    return trim($value) === '' ? null : $value;
}

function validaCPF($cpf) {
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function addMensagem($tipo, $mensagem) {
    if (!isset($_SESSION['mensagens'])) {
        $_SESSION['mensagens'] = [];
    }
    $_SESSION['mensagens'][] = [
        'tipo' => $tipo,
        'mensagem' => $mensagem
    ];
}

function formatCnpjCpf($value){
  $CPF_LENGTH = 11;
  $cnpj_cpf = preg_replace("/\D/", '', $value);
  
  if (strlen($cnpj_cpf) === $CPF_LENGTH) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  } 
  
  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

function formatTelefone($value){
  $value = preg_replace("/\D/", '', $value);
  
  if (strlen($value) === 11) {
    return preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1) \$2-\$3", $value);
  }
  elseif(strlen($value) === 10) {
    return preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $value);
  }
  return $value;
}