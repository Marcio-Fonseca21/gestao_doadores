<?php

class Doacao
{
    // Propriedades (Mantendo os nomes que você definiu)
    private $id_doacao;
    private $hospital_id;
    private $dador_id;
    private $campanha_id;
    private $data_criacao;
    private $quantidade;
    private $pressao_arterial;
    private $status_doacao;
    private $motivo;
    private $data_doacao;
    private $data_marcacao;
    private $gravidez_recente;
    private $data_ultima_avaliacao_medica;
    private $tipo_de_doacao;

  public function criarAgendamento($usuarioId, $campanhaId)
{
    $db = new Database();
    $conn = $db->getConexao();

    try {
        // 1. Obter o idDador
        $sqlDador = "SELECT idDador FROM dador WHERE usuarioId = :uId LIMIT 1";
        $stmtDador = $conn->prepare($sqlDador);
        $stmtDador->execute([':uId' => $usuarioId]);
        $dador = $stmtDador->fetch(PDO::FETCH_ASSOC);

        if (!$dador) {
            throw new Exception("Perfil de dador não encontrado.");
        }

        $idDador = $dador['idDador'];

        // 2. VERIFICAÇÃO DE DUPLICIDADE (O QUE FALTA)
        // Verificamos se já existe uma doação 'Pendente' para este dador nesta campanha
        $sqlCheck = "SELECT id_doacao FROM doacao 
                     WHERE dador_id = :dador 
                     AND campanha_id = :campanha 
                     AND status_doacao = 'Pendente' LIMIT 1";
        
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->execute([
            ':dador'    => $idDador,
            ':campanha' => $campanhaId
        ]);

        if ($stmtCheck->fetch()) {
            throw new Exception("Já possui um agendamento pendente para esta campanha.");
        }

        // 3. Buscar o hospital_id da campanha
        $sqlCampanha = "SELECT hospital_id FROM campanha WHERE id_campanha = :cId LIMIT 1";
        $stmtCamp = $conn->prepare($sqlCampanha);
        $stmtCamp->execute([':cId' => $campanhaId]);
        $campanha = $stmtCamp->fetch(PDO::FETCH_ASSOC);

        if (!$campanha) {
            throw new Exception("Campanha inválida.");
        }

        // 4. Inserir se não houver duplicado
        $sql = "INSERT INTO doacao (dador_id, campanha_id, hospital_id, status_doacao, data_marcacao) 
                VALUES (:dador, :campanha, :hospital, 'Pendente', NOW())";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':dador'    => $idDador,
            ':campanha' => $campanhaId,
            ':hospital' => $campanha['hospital_id']
        ]);

    } catch (PDOException $e) {
        throw new Exception("Erro SQL: " . $e->getMessage());
    }
}





public function listarAgendamentosPorDador($usuarioId)
{
    $db = new Database();
    $conn = $db->getConexao();

    // 1. Buscar o idDador do usuário logado
    $sqlDador = "SELECT idDador FROM dador WHERE usuarioId = :uId LIMIT 1";
    $stmtDador = $conn->prepare($sqlDador);
    $stmtDador->execute([':uId' => $usuarioId]);
    $dador = $stmtDador->fetch(PDO::FETCH_ASSOC);

    if (!$dador) return [];

    // 2. Buscar as doações usando JOIN para pegar nomes de hospital e campanha
    $sql = "SELECT 
                d.status_doacao, 
                d.motivo, 
                d.data_marcacao, 
                c.nome_campanha, 
                h.nome as nome_hospital
            FROM doacao d
            JOIN campanha c ON d.campanha_id = c.id_campanha
            JOIN hospital h ON d.hospital_id = h.id_hospital
            WHERE d.dador_id = :dadorId
            ORDER BY d.data_marcacao DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':dadorId' => $dador['idDador']]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function registarDoacaoVoluntaria($usuarioId, $hospitalId, $dataPretendida)
{
    $db = new Database();
    $conn = $db->getConexao();

    // 1. Buscar o idDador
    $sqlDador = "SELECT idDador FROM dador WHERE usuarioId = :uId LIMIT 1";
    $stmtDador = $conn->prepare($sqlDador);
    $stmtDador->execute([':uId' => $usuarioId]);
    $dador = $stmtDador->fetch(PDO::FETCH_ASSOC);

    if (!$dador) throw new Exception("Perfil de dador não encontrado.");

    // 2. Inserir (tipo_de_doacao = 'Voluntária')
    $sql = "INSERT INTO doacao (dador_id, hospital_id, status_doacao, data_marcacao, tipo_de_doacao) 
            VALUES (:dador, :hospital, 'Pendente', :dataM, 'Voluntária')";
    
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':dador'    => $dador['idDador'],
        ':hospital' => $hospitalId,
        ':dataM'    => $dataPretendida
    ]);
}
}