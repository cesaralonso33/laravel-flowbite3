@props(['disabled' => false,'required'=>false,'items'=>[],'usekey' => false,'select'=>false,'isarray'=>false ])


<select

{{ $required ? 'required' : '' }}
{{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge(['class' => 'border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}>

<option value="">==== Seleccionar ====</option>
@forelse ($items as $item => $value)

<option value="{{($usekey ?  $items[$item][$usekey] : $value )}}"
{{ ( $select===$value ? 'selected' : '') }}
{{ ( $select===$item ? 'selected' : '') }}
    >{{ ( $isarray ?  $items[$item][$usekey] : $value )}} </option>
@empty

@endforelse

</select>
