<?php

namespace Core;

class FileDB
{

    private string $file_name;
    private array $data;

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Gets data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }

    /**
     * Sets data
     *
     * @param array $data_array
     * @return void
     */
    public function setData(array $data_array): void
    {
        $this->data = $data_array;
    }

    /**
     * Saves changes made to the $data file
     *
     * @return boolean
     */
    public function save(): bool
    {
        $bytes_written = file_put_contents($this->file_name, json_encode($this->getData()));

        return $bytes_written !== false;
    }

    /**
     * Loads data
     *
     * @return boolean
     */
    public function load(): bool
    {
        if (file_exists($this->file_name)) {
            if (file_get_contents($this->file_name) !== false) {
                $this->setData(json_decode(file_get_contents($this->file_name), true) ?? []);
            }
        } else {
            $this->setData([]);

            return true;
        }

        return false;
    }

    /**
     * Creates a table array in datafile with the given name
     *
     * @param string $table_name
     * @return boolean
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];

            return true;
        }

        return false;
    }

    /**
     * Checks if a table with a given name exists
     *
     * @param string $table_name
     * @return boolean
     */
    public function tableExists(string $table_name): bool
    {
        return isset($this->data[$table_name]);
    }

    /**
     * Deletes a table with a given name
     *
     * @param string $table_name
     * @return boolean
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    /**
     * Clears data from the designated table
     *
     * @param string $table_name
     * @return boolean
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Inserts a row array with a given name to a designated table array
     *
     * @param string $table_name
     * @param [type] $row
     * @param [type] $row_id
     * @return void
     */
    public function insertRow(string $table_name, $row, $row_id = null)
    {
        if ($this->rowExists($table_name, $row_id)) {

            return false;
        }
        if ($row_id) {
            $this->data[$table_name][$row_id] = $row;
        } else {
            $this->data[$table_name][] = $row;
            $row_id = array_key_last($this->data[$table_name]);
        }

        return $row_id;
    }

    /**
     * Checks if a row array with the given name exists in the designated table array
     *
     * @param string $table_name
     * @param [type] $row_id
     * @return boolean
     */
    public function rowExists(string $table_name, $row_id): bool
    {
        return array_key_exists($row_id, $this->data[$table_name]);
    }

    /**
     * Replaces the old row data in a given table with the given new data
     *
     * @param string $table_name
     * @param [type] $row_id
     * @param [type] $row
     * @return boolean
     */
    public function updateRow(string $table_name, $row_id, $row): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;

            return true;
        }

        return false;
    }

    /**
     * Appends given data to the selected row in the selected table
     *
     * @param string $table_name
     * @param [type] $row_id
     * @param [type] $new_data
     * @return boolean
     */
    public function appendRow(string $table_name, $row_id, $new_data): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] += $new_data;

            return true;
        }

        return false;
    }

    /**
     * Deletes the row array of the given name from the designated table array
     *
     * @param string $table_name
     * @param [type] $row_id
     * @return boolean
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     * Gets the row array of the given name from the designated table
     *
     * @param string $table_name
     * @param [type] $row_id
     * @return void
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * Returns all row arrays matching the given conditions in the designated table array
     *
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions = []): array
    {
        $results = [];

        foreach ($this->data[$table_name] ?? [] as $r_index => $row) {
            $valid = true;

            foreach ($conditions as $c_index => $c_value) {
                if ($c_value !== $row[$c_index]) {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $results[$r_index] = $row;
            }
        }

        return $results;
    }

    /**
     * Gets the first row array matching the given conditions from the designated table array
     *
     * @param string $table_name
     * @param array $conditions
     * @return bool|array 
     */
    public function getRowWhere(string $table_name, array $conditions = [])
    {
        foreach ($this->data[$table_name] ?? [] as $row) {
            $valid = true;

            foreach ($conditions as $c_index => $c_value) {
                if ($c_value !== $row[$c_index]) {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                return $row;
            }
        }

        return false;
    }

    public function deleteRows(string $table_name, array $conditions = [])
    {
        foreach ($this->data[$table_name] ?? [] as $row_index => $row) {
            $valid = true;

            foreach ($conditions as $c_index => $c_value) {
                if ($c_value !== $row[$c_index]) {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $this->deleteRow($table_name, $row_index);
            }
        }

        return false;
    }
}
