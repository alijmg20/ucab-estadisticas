<?php

namespace App\Http\Livewire\Graphics\Correlation;

use App\Models\Correlation;
use App\Models\Register;
use App\Models\Variable;
use Livewire\Component;

class VariableCorrelation extends Component
{

    public $correlation;
    public $variable1, $variable2;
    public $responsed;
    protected $listeners = [ 'render', 'generateComparisonChart'];
    public function mount($correlation)
    {
        $this->correlation = Correlation::find($correlation);
    }

    public function render()
    {
        if ($this->correlation) {
            // dd($this->getColumnSummaries() , $this->unionVariables());
            $tableData = $this->unionVariables();
            $this->responsed['chiSquare'] = $this->calculateChiSquare();
            $this->responsed['degreesOfFreedomChiSquare'] = $this->calculateDegreesOfFreedom()['degreesOfFreedomChiSquare'];
            $this->responsed['cramerv'] = $this->calculateCramersV();
            $this->responsed['degreesOfFreedomCramersV'] = $this->calculateDegreesOfFreedom()['degreesOfFreedomCramersV'];
        } else {
            $tableData = [];
        }
        return view('livewire.graphics.correlation.variable-correlation', compact('tableData'));
    }

    public function unionVariables()
    {
        $vars = $this->correlation->variables;
        $this->variable1 = $variable1 = $vars[0]; // filas
        $this->variable2 = $variable2 = $vars[1]; // columnas
    
        $registers = Register::where('file_id', $this->correlation->file_id)->get();
    
        $tableData = [];
        $rowTotals = [];
        $columnTotals = [];
    
        foreach ($registers as $register) {
            $data1 = $variable1->data()->where('register_id', $register->id)->first();
            $data2 = $variable2->data()->where('register_id', $register->id)->first();
    
            if ($data1 && $data2) {
                $value1 = $data1->value;
                $value2 = $data2->value;
    
                // Agrupa los valores de variable2 bajo las categorías de variable1
                if (!isset($tableData[$value1])) {
                    $tableData[$value1] = [];
                }
    
                if (!isset($tableData[$value1][$value2])) {
                    $tableData[$value1][$value2] = 1;
                } else {
                    $tableData[$value1][$value2]++;
                }
    
                // Calcula totales de filas
                if (!isset($rowTotals[$value1])) {
                    $rowTotals[$value1] = 1;
                } else {
                    $rowTotals[$value1]++;
                }
    
                // Calcula totales de columnas
                if (!isset($columnTotals[$value2])) {
                    $columnTotals[$value2] = 1;
                } else {
                    $columnTotals[$value2]++;
                }
            }
        }
    
        // Reemplaza nombres de fila vacíos con "Sin respuesta"
        if (array_key_exists("", $tableData)) {
            $tableData["Sin respuesta"] = $tableData[""];
            unset($tableData[""]);
        }
    
        // Ordena alfabéticamente las filas en tableData
        ksort($tableData);
    
        // Ordena alfabéticamente las claves en rowTotals y columnTotals
        ksort($rowTotals);
        ksort($columnTotals);
    
        // Añade "Sin respuesta" al final de rowTotals si está presente
        if (array_key_exists("", $rowTotals)) {
            $rowTotals["Sin respuesta"] = $rowTotals[""];
            unset($rowTotals[""]);
        }
    
        // Añade "Sin respuesta" al final de columnTotals si está presente
        if (array_key_exists("", $columnTotals)) {
            $columnTotals["Sin respuesta"] = $columnTotals[""];
            unset($columnTotals[""]);
        }
    
        // Reemplaza nombres de fila vacíos por "Sin respuesta" en subarreglos de tableData
        foreach ($tableData as &$rowData) {
            if (array_key_exists("", $rowData)) {
                $rowData["Sin respuesta"] = $rowData[""];
                unset($rowData[""]);
            }
        }
    
        return [
            'tableData' => $tableData,
            'rowTotals' => $rowTotals,
            'columnTotals' => $columnTotals,
        ];
        // Puedes usar estos datos para mostrar totales en la tabla en la vista.
    }    
    

    public function calculateChiSquare()
    {
        // Obtén los datos y totales como lo hiciste en unionVariables()
        $tableData = $this->unionVariables();
        $rowTotals = $tableData['rowTotals'];
        $columnTotals = $tableData['columnTotals'];

        $observed = []; // Matriz de valores observados

        // Llena la matriz de valores observados
        foreach ($tableData['tableData'] as $row => $rowData) {
            foreach ($columnTotals as $column => $total) {
                $observed[$row][$column] = isset($rowData[$column]) ? $rowData[$column] : 0;
            }
        }

        // Calcula el total de observaciones
        $totalObservations = array_sum($rowTotals);

        // Calcula el estadístico chi-cuadrado
        $chiSquare = 0;
        foreach ($tableData['tableData'] as $row => $rowData) {
            foreach ($columnTotals as $column => $total) {
                $expected = ($rowTotals[$row] * $columnTotals[$column]) / $totalObservations;
                $chiSquare += (($observed[$row][$column] - $expected) ** 2) / $expected;
            }
        }

        return $chiSquare;
    }

    public function calculateCramersV()
    {
        // Obtén los datos y totales como lo hiciste en unionVariables()
        $tableData = $this->unionVariables();
        $rowTotals = $tableData['rowTotals'];
        $columnTotals = $tableData['columnTotals'];

        $observed = []; // Matriz de valores observados

        // Llena la matriz de valores observados
        foreach ($tableData['tableData'] as $row => $rowData) {
            foreach ($columnTotals as $column => $total) {
                $observed[$row][$column] = isset($rowData[$column]) ? $rowData[$column] : 0;
            }
        }

        // Calcula el total de observaciones
        $totalObservations = array_sum($rowTotals);

        // Calcula el mínimo de filas y columnas
        $minRowsColumns = min(count($rowTotals), count($columnTotals));

        // Calcula el coeficiente de contingencia (Cramér's V)
        $chiSquare = $this->calculateChiSquare();
        $cramersV = sqrt($chiSquare / ($totalObservations * ($minRowsColumns - 1)));

        return $cramersV;
    }

    public function calculateDegreesOfFreedom()
    {
        // Obtén los datos y totales como lo hiciste en unionVariables()
        $tableData = $this->unionVariables();
        $rowTotals = $tableData['rowTotals'];
        $columnTotals = $tableData['columnTotals'];

        // Calcula los grados de libertad para el estadístico chi-cuadrado
        $degreesOfFreedomChiSquare = (count($rowTotals) - 1) * (count($columnTotals) - 1);

        // Calcula los grados de libertad para el coeficiente de contingencia (Cramér's V)
        $minRowsColumns = min(count($rowTotals), count($columnTotals));
        $degreesOfFreedomCramersV = $minRowsColumns - 1;

        return [
            'degreesOfFreedomChiSquare' => $degreesOfFreedomChiSquare,
            'degreesOfFreedomCramersV' => $degreesOfFreedomCramersV,
        ];
    }

    public function generateComparisonChart()
    {
        $vars = $this->correlation->variables;
        $variable1 = $vars[0]; // filas
        $variable2 = $vars[1]; // columnas
    
        $registers = Register::where('file_id', $this->correlation->file_id)->get();
    
        $tableData = $this->generateTableData($variable1, $variable2, $registers);
        $categories = $this->generateCategories($variable1, $variable2, $tableData);
    
        // Ordena el arreglo de categorías alfabéticamente
        sort($categories);
    
        // Agrega "Sin respuesta" al final
        $categories[] = "Sin respuesta";
    
        $chartData = [
            'tableData' => $tableData,
            'correlation' => $this->correlation,
            'categories' => $categories,
        ];
    
        // Emitir un evento con los datos del gráfico
        $this->emit('updateChartData', $chartData);
    }
    
    private function generateTableData($variable1, $variable2, $registers)
    {
        $tableData = [];
    
        foreach ($registers as $register) {
            $data1 = $variable1->data()->where('register_id', $register->id)->first();
            $data2 = $variable2->data()->where('register_id', $register->id)->first();
    
            if ($data1 && $data2) {
                $value1 = $data1->value;
                $value2 = $data2->value;
    
                // Agrupa los valores de variable1 bajo las categorías de variable2
                if (!isset($tableData[$value2])) {
                    $tableData[$value2] = [];
                }
    
                if (!isset($tableData[$value2][$value1])) {
                    $tableData[$value2][$value1] = 1;
                } else {
                    $tableData[$value2][$value1]++;
                }
            }
        }
    
        // Recorre todos los subíndices para asegurarse de que estén definidos
        foreach ($tableData as &$data) {
            foreach ($tableData as $key1 => $subArray) {
                foreach (array_keys($tableData[$key1]) as $key2) {
                    $data[$key2] = $data[$key2] ?? 0;
                }
            }
            ksort($data); // Ordena los subarreglos dentro de tableData
        }
    
        // Reemplaza valores vacíos con "Sin respuesta" en variable1
        foreach ($tableData as &$data) {
            foreach ($data as $key => $value) {
                if ($key === "") {
                    $data["Sin respuesta"] = $data[$key];
                    unset($data[$key]);
                }
            }
        }
    
        // Reemplaza nombres de columna vacíos o nulos con "Sin respuesta"
        foreach (array_keys($tableData) as $column) {
            if (empty($column) || is_null($column)) {
                $tableData["Sin respuesta"] = $tableData[$column];
                unset($tableData[$column]);
            }
        }
    
        // Calcula los porcentajes después de ordenar y cambiar a "Sin respuesta"
        $rowTotals = $this->unionVariables()['rowTotals'];
        foreach ($tableData as &$data) {
            foreach ($data as $key => $value) {
                $data[$key] = ($value / $rowTotals[$key]) * 100;
            }
        }
    
        return $tableData;
    }
    
    
    
    private function generateCategories($variable1, $variable2, $tableData)
    {
        $categories1 = $variable1->data()->distinct('value')->pluck('value')->toArray();
        $categories2 = $variable2->data()->distinct('value')->pluck('value')->toArray();
    
        foreach ($categories2 as $category2) {
            if (!isset($tableData[$category2])) {
                $tableData[$category2] = [];
            }
            foreach ($categories1 as $category1) {
                if (!isset($tableData[$category2][$category1])) {
                    $tableData[$category2][$category1] = 0;
                }
            }
        }
    
        // Crea el arreglo de categorías
        $categories = [];
        foreach ($categories1 as $category) {
            if (empty($category) || is_null($category)) {
                // Ignora "Sin respuesta" temporalmente
                continue;
            } else {
                $categories[] = $category;
            }
        }
    
        return $categories;
    }
    
}
