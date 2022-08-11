<?php

    namespace App\Filters;

    use Illuminate\Http\Request;

    class ApiFilter
    {
        protected $allowedParameters = [];

        protected $columnMap = [];

        protected $operatorMap = [];

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
    