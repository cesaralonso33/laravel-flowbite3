
<div class="w-full p-3 text-sm">


    @switch($type)

            @case("TEXT")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>

            <x-text-input
                id="{{$name}}"
                class="block mt-1 w-full"
                type="text"
                name="{{$name}}"
                :required="$required"
                :disabled="$block"
                :inputvalue="strtoupper(( !empty($values) ? $values[$name]:''))"
                />

            @break

            @case("INT")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
            <x-text-input id="{{$name}}" class="block mt-1 w-full" type="number" name="{{$name}}" :disabled="$block" :required="$required"  :inputvalue="strtoupper(( !empty($values) ? $values[$name]:''))" />

            @break

            @case("BOOLEAN")
            <x-toggle-crad id="{{$name}}" :name="$name" :required="$required" :checked="($values[$name] ? $values[$name]:false)" :type="$type" :labelc="$label"/>

            @break

            @case("DECIMAL")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>
            <x-text-input :disabled="$block" id="{{$name}}" class="block mt-1 w-full" type="number"  step="0.01" name="{{$name}}" :required="$required" :inputvalue="strtoupper(( !empty($values) ? $values[$name]:''))" />

            @break



            @case("DATE")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
              <x-text-input :disabled="$block" id="{{$name}}" class="block mt-1 w-full" type="date"    name="{{$name}}" :required="$required" :inputvalue="strtoupper(( !empty($values) ? $values[$name]:''))" />

            @break


            @case("LIST")

                    @if($list)
                    <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
                    <x-selected :disabled="$block"  id="{{$name}}" name="{{$name}}" :items="$customFunction($name)" :required="$required" :select="($values[$name] ? $values[$name]: '')"/>
                    @endif

            @break

            @case("LIST_TABLE")
              {{--       @if ($listtable)
                    {{ list_table($listtable)}}
                    <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
                    <x-selected  id="{{$name}}" name="{{$name}}" :items="$customFunction($name)" :required="$required" :select="$values[$name]"/>

                    @endif --}}
            @break




            @case("JSON")

            @break

            @case("IMAGE")



                {!! (Cache::get($values['id'])) !!}

            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>
            <x-text-input :disabled="$block"   multiple  id="{{$name}}"   type="file"   name="files[]"   :required="$required"   />



            @break
            @case("LONGTEXT")
            <x-textarea-crad id="{{$name}}" name="{{$name}}" :required="$required"  :value="strtoupper(( !empty($values) ? $values[$name]:''))"  :labelc="$label"/>

            @break
        @default

    @endswitch


     <x-input-error :messages="$errors->get($name)" class="mt-2" />



</div>
