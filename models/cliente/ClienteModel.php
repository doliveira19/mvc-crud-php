<?php
class ClienteModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllClientes()
    {
        $query = $this->conn->query("SELECT * FROM cliente");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClienteById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cliente WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function adicionarCliente($cliente)
    {
        $sql = "INSERT INTO cliente (nome, email, telefone, endereco_cep, endereco, endereco_complemento, endereco_numero, endereco_bairro, endereco_cidade, endereco_estado)";
        $sql .= " VALUES (:nome, :email, :telefone, :endereco_cep, :endereco, :endereco_complemento, :endereco_numero, :endereco_bairro, :endereco_cidade, :endereco_estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $cliente['nome']);
        $stmt->bindParam(':email', $cliente['email']);
        $stmt->bindParam(':telefone', preg_replace('/[^0-9]/s', '', $cliente['telefone']));
        $stmt->bindParam(':endereco_cep', preg_replace('/[^0-9]/s', '', $cliente['endereco_cep']));
        $stmt->bindParam(':endereco', $cliente['endereco']);
        $stmt->bindParam(':endereco_complemento', $cliente['endereco_complemento']);
        $stmt->bindParam(':endereco_numero', $cliente['endereco_numero']);
        $stmt->bindParam(':endereco_bairro', $cliente['endereco_bairro']);
        $stmt->bindParam(':endereco_cidade', $cliente['endereco_cidade']);
        $stmt->bindParam(':endereco_estado', $cliente['endereco_estado']);
        return $stmt->execute();
    }

    public function editarCliente($id, $cliente)
    {
        if (empty($cliente)) {
            return false;
        }

        $fields = [];
        foreach ($cliente as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $setFields = implode(', ', $fields);

        $sql = "UPDATE cliente SET $setFields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        foreach ($cliente as $kkey => $vvalue) {
            if ($kkey == "telefone" || $kkey == "endereco_cep") {
                $vvalue = preg_replace('/[^0-9]/s', '', $vvalue);
            }
            $stmt->bindValue(":$kkey", $vvalue);
        }

        return $stmt->execute();
    }

    public function excluirCliente($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM cliente WHERE id=:id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
