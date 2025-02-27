@props(['disabled' => false, 'value' => '']) <!-- Add value prop -->

<textarea {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full']) }}>
    {{ $value }}
</textarea>
