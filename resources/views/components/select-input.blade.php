@props(['disabled' => false, 'options' => [], 'value' => null, 'placeholder' => '-- Select an Option --'])

<select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full']) }}>
    <option value="">{{ $placeholder }}</option> <!-- Dynamic placeholder -->
    @foreach ($options as $optionValue => $label)
        <option value="{{ $optionValue }}" {{ $optionValue == $value ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
