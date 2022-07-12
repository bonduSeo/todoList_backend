<?php

namespace application\models;

use PDO;

class TodoModel extends Model
{
    public function insTodo(&$param)
    {
        $sql =
            "   INSERT INTO t_todo
                (todo)
                VALUES
                (:todo)  
            ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$param['todo']]);
        return  intval($this->pdo->lastInsertId());
    }

    public function selTodoList()
    {
        $sql =
            "   SELECT itodo, todo, created_at
                 FROM t_todo
                 ORDER BY itodo
            ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delTodo(&$param)
    {
        $sql = "DELETE FROM t_todo";

        $itodo = $param["itodo"];
        if ($itodo > 0) {
            $sql .= " WHERE itodo = {$itodo}";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
