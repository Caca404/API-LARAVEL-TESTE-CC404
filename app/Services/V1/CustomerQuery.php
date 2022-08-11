<?php

    namespace App\Services\V1;

    use Illuminate\Http\Request;

    class CustomerQuery 
    {
        protected $allowedParameters = [
            'name' => ['eq'],
            'type' => ['eq'],
            'email' => ['eq'],
            'address' => ['eq'],
            'city' => ['eq'],
            'state' => ['eq'],
            'postalCode' => ['eq', 'gt', 'lt', 'gte', 'lte', 'df']
        ];

        protected $columnMap = [
            'postalCode' => "postal_code"
        ];

        protected $operatorMap = [
            'eq' => '=',
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'df' => "!="
        ];

        public function transform(Request $request)
        {
            $eloquentQuery = [];

            foreach ($this->allowedParameters as $parameter => $operators) {
                $query = $request->query($parameter);

                if(!isset($query))
                    continue;

                $column = $this->columnMap[$parameter] ?? $parameter;

                foreach ($operators as $operator) {
                    if(isset($query[$operator]))
                        $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

            return $eloquentQuery;
        }
    }
    