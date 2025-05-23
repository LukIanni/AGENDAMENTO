<?php

class Tcc {
    private $data_file = 'data/tccs.json';

    public function listar() {
        return $this->carregarTccs();
    }

    public function salvar($dados) {
        $tccs = $this->carregarTccs();
        $tccs[] = $dados;
        return $this->salvarTccs($tccs);
    }

    public function buscar($id) {
        $tccs = $this->carregarTccs();
        return $tccs[$id] ?? null;
    }

    public function excluir($id) {
        $tccs = $this->carregarTccs();
        if (isset($tccs[$id])) {
            unset($tccs[$id]);
            $tccs = array_values($tccs); // Reindexar o array
            return $this->salvarTccs($tccs);
        }
        return false;
    }

    public function verificarDisponibilidade($dataHora) {
        $tccs = $this->carregarTccs();
        foreach ($tccs as $tcc) {
            if ($tcc['apresentacao'] == $dataHora) {
                return false; // Já existe um TCC agendado para esta data e hora
            }
        }
        return true; // Data e hora disponíveis
    }

    private function carregarTccs() {
        if (file_exists($this->data_file)) {
            $json = file_get_contents($this->data_file);
            return json_decode($json, true) ?? [];
        }
        return [];
    }

    private function salvarTccs($tccs) {
        $json = json_encode($tccs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($this->data_file, $json) !== false;
    }
}

?>