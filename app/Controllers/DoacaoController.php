<?php

class DoacaoController
{
    public function agendar()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['usuario'])) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Sessão expirada.']);
            exit;
        }

        $json = file_get_contents('php://input');
        $dados = json_decode($json, true);
        $idUsuario = $_SESSION['usuario']['id_usuario'];


        // Captura os dados (podem vir de campanha ou voluntário)
        $campanhaId = $dados['campanha_id'] ?? null;
        $hospitalId = $dados['hospital_id'] ?? null;
        $dataMarcacao = $dados['data_marcacao'] ?? null;

        try {
            $doacao = new Doacao();

            if ($campanhaId) {
                // Se tem campanha_id, segue o fluxo normal
                $sucesso = $doacao->criarAgendamento($idUsuario, $campanhaId);
            } else if ($hospitalId && $dataMarcacao) {
                // Se não tem campanha, mas tem hospital e data, é VOLUNTÁRIA
                $sucesso = $doacao->registarDoacaoVoluntaria($idUsuario, $hospitalId, $dataMarcacao);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos para agendamento.']);
                exit;
            }

            if ($sucesso) {
                echo json_encode(['status' => 'sucesso']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Não foi possível salvar no banco.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
        }
        exit;
    }
}