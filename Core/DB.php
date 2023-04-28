<?php


namespace Core;

use PDO;

abstract class DB
{

    private const ACTION_SELECT = 'select';

    private const ACTION_UPDATE = 'update';

    private const ACTION_CREATE = 'create';

    private const ACTION_DELETE = 'delete';

    private $db;

    private string $currentAction;

    protected ?string $table = null;

    private string $sql = '';

    private string $select = '*';

    private ?string $limit = null;

    private ?string $offset = null;

    private array $where = [];

    private array $insertData = [];

    private array $updateData = [];

    private array $params = [];

    private bool $isMultiple = true;

    public function __construct()
    {

        try {
            if (
                !defined('DB_HOST') ||
                !defined('DB_NAME') ||
                !defined('DB_USERNAME') ||
                !defined('DB_PASSWORD')
            ) {
                throw new \Exception("DB credentials not defined");
            }
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }


    public function setAction(string $action): void
    {
        $this->currentAction = $action;
    }

    public function setMultiple(bool $isMultiple)
    {
        $this->isMultiple = $isMultiple;
    }

    public function buildQuery()
    {
        switch ($this->currentAction) {
            case self::ACTION_SELECT:
                $this->buildSelect();
                break;
            case self::ACTION_UPDATE:
                $this->buildUpdate();
                break;
            case self::ACTION_DELETE:
                $this->buildDelete();
                break;
            case self::ACTION_CREATE:
                $this->buildCreate();
                break;
        }
    }


    public function buildDelete()
    {
        $this->sql = 'Delete from ' . $this->table;
        $this->handleWhere();
        $this->handleLimit();
    }


    public function buildUpdate()
    {
        if (!$this->updateData) {
            throw new \Exception('No updateData');
        }
        $this->sql = 'Update ' . $this->table;
        $index = 0;
        foreach ($this->updateData as $column => $value) {
            if ($index == 0) {
                $this->sql .= ' set ';
            }
            $this->sql .= $column . ' = ?';
            $this->params[] = $value;
            $this->sql .= ',';
            $index++;
        }
        $this->sql = rtrim($this->sql, ',');
        $this->handleWhere();
        $this->handleLimit();
    }


    public function buildCreate()
    {
        if (!$this->insertData) {
            throw new \Exception('No insertData');
        }
        $this->sql = 'Insert into ' . $this->table;
        $this->sql .= ' (';
        foreach ($this->insertData as $column => $value) {
            $this->sql .= $column . ',';
            $this->params[] = $value;
        }
        $this->sql = rtrim($this->sql, ',');
        $this->sql .= ') values ';
        $questionMarks = rtrim(str_repeat('?,', count($this->params)), ',');
        $this->sql .= '(' . $questionMarks . ')';
    }


    public function buildSelect()
    {
        $this->sql = 'Select ' . $this->select . " from " . $this->table;
        $this->handleWhere();
        $this->handleLimit();

    }

    public function handleLimit(): void
    {
        if ($this->limit) {
            if ($this->offset) {
                $this->sql .= ' limit ' . $this->offset . ',' . $this->limit;
            } else {
                $this->sql .= ' limit ' . $this->limit;
            }

        }
    }


    public function where(string $column, $query, string $operator = '=')
    {
        $this->where[] = [
            'column' => $column,
            'query' => $query,
            'operator' => $operator
        ];
        return $this;
    }

    public function handleWhere()
    {
        foreach ($this->where as $index => $where) {
            if ($index == 0) {
                $this->sql .= ' where ';
            } else {
                $this->sql .= ' and ';
            }
            $this->sql .= $where['column'] . ' ' . $where['operator'] . ' ?';
            $this->params[] = $where['query'];
        }
    }

    public function setLimit($limitData)
    {
        $this->limit = (string)$limitData;
        return $this;
    }

    public function setOffset($offset)
    {
        $this->offset = (string)$offset;
        return $this;
    }

    public function select(array $selectList = ['*'])
    {
        $this->select = implode(',', $selectList);
        return $this;
    }


    public function runQuery()
    {
        if (!$this->sql) {
            throw new \Exception('no sql');
        }
        $query = $this->db->prepare($this->sql);
        $query->execute($this->params);
        if ($this->currentAction == self::ACTION_SELECT) {
            $query->execute();
            if ($this->isMultiple) {
                $res = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $res = $query->fetch(PDO::FETCH_OBJ);
            }
            return $res;
        }
        return $this;
    }


    private function reset()
    {
        $this->where = [];
        $this->setMultiple(true);
        $this->select = '*';
        $this->limit = null;
        $this->offset = null;
        $this->sql = '';
        $this->insertData = [];
        $this->updateData = [];
    }


    public function first()
    {
        $this->setAction(self::ACTION_SELECT);
        $this->setMultiple(false);
        $this->setLimit(1);
        $this->buildQuery();
        $response = $this->runQuery();
        $this->reset();
        return $response;
    }

    public function all()
    {
        $this->setAction(self::ACTION_SELECT);
        $this->setMultiple(true);
        $this->buildQuery();
        $response = $this->runQuery();
        $this->reset();
        return $response;
    }


    public function create(array $insertData)
    {
        $this->insertData = $insertData;
        $this->setAction(self::ACTION_CREATE);
        $this->buildQuery();
        $response = $this->runQuery();
    }

    public function update(array $updateData)
    {
        $this->updateData = $updateData;
        $this->setAction(self::ACTION_UPDATE);
        $this->buildQuery();
        $response = $this->runQuery();
        $this->reset();
    }

    public function delete()
    {

        $this->setAction(self::ACTION_DELETE);
        $this->buildQuery();
        $response = $this->runQuery();
        $this->reset();
    }
}

