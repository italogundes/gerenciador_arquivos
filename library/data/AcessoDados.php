<?php

class AcessoDados extends PDO {
     public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        // Executa o construtor da da classe pai (PDO) que inicializa a conexão
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';client_encoding=utf8', $DB_USER, $DB_PASS);
        
    }


    public function select($sql, $array = array(), $all = TRUE, $fetchMode = PDO::FETCH_ASSOC)
    {
        // Prepara a Query

            $sth = $this->prepare($sql);


            // Define os dados do Where, se existirem.
            foreach ($array as $key => $value) {
                // Se o tipo do dado for inteiro, usa PDO::PARAM_INT, caso contrário, PDO::PARAM_STR
                $tipo = (is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;

                // Define o dado
                $sth->bindValue("$key", $value, $tipo);
            }

            // Executa
             $sth->execute();
        
            // Executar fetchAll() ou fetch()?
            if ($all) {
                // Retorna a coleção de dados (array multidimensional)
                return $sth->fetchAll($fetchMode);
            } else {
                // Retorna apenas um dado
                return $sth->fetchAll($fetchMode);
            }

    }

    
    public function insert($table, $data)
    {
        
        // Ordena
       //$retorno = Array();
        ksort($data);

        // Campos e valores
        $camposNomes = implode(', ', array_keys($data));
        $camposValores = ':' . implode(', :', array_keys($data));

        // Prepara a Query
        $sth = $this->prepare("INSERT INTO $table ($camposNomes) VALUES ($camposValores)");

        // Define os dados
        foreach ($data as $key => $value)
        {
            // Se o tipo do dado for inteiro, usa PDO::PARAM_INT, caso contrário, PDO::PARAM_STR  
            $tipo = ( is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            
            // Define o dado
            $sth->bindValue(":$key", $value, $tipo);
        }
        
        
        $sth->execute();
        // Retorna o ID desse item inserido
        //return $this->lastInsertId();
        //print_r($sth->errorInfo());
        
        
        $id= (int) $this->lastInsertId();
        return $id;
    }


    
    public function update($table, $data, $where)
    {
        // Ordena
        ksort($data);

        // Define os dados que serão atualizados
        $novosDados = NULL;
        
        foreach($data as $key=> $value)
        {
            $novosDados .= "$key =:$key,";
        }
        
        $novosDados = rtrim($novosDados, ',');

        // Prepara a Query
        $sth = $this->prepare("UPDATE $table SET $novosDados WHERE $where");

        // Define os dados
        foreach ($data as $key => $value)
        {
            // Se o tipo do dado for inteiro, usa PDO::PARAM_INT, caso contrário, PDO::PARAM_STR  
            $tipo = ( is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            
            // Define o dado
            $sth->bindValue(":$key", $value, $tipo);
        }

        // Sucesso ou falha?
		
        $sth->execute();
		//print_r($sth->errorInfo());
		return;
    }


    public function delete($table, $where)
    {
        // Deleta
      // $sth =  $this->prepare("DELETE FROM $table WHERE $where");
       //return $sth->queryString;
       
    	return $this->exec("DELETE FROM $table WHERE $where");
       
    }
    
    public function beginTransaction() {
    	return parent::beginTransaction();
    }
    
    public function commit() {
    	return parent::commit();
    }
    
    public function rollBack() {
    	return parent::rollback();
    }
}
