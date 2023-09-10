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
    protected $listeners = ['delete', 'render','edit'];
    public function mount($correlation)
    {
        $this->correlation = Correlation::find($correlation);
    }

    public function render()
    {
        $tableData = $this->unionVariables();
        return view('livewire.graphics.correlation.variable-correlation', compact('tableData'));
    }

    public function delete()
    {
        $this->emit('correlationDelete', $this->correlation->id);
    }

    public function edit()
    {
        $this->emitTo('graphics.correlation.correlation-modal','correlationEdit', $this->correlation->id);
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
}
