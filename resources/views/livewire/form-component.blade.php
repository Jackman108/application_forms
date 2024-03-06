<div>
    <!-- /resources/views/livewire/form-component.blade.php -->
    <!-- Форма для ввода данных -->
    <form method="POST" action="{{ route('submit.form') }}" enctype="multipart/form-data">
        @csrf
        <!-- Поле Имя -->
        <div class="mb - 3">
            <label for="first_name" class="form - label">Имя</label>
            <input type="text" class="form - control" id="first_name" wire:model.defer="first_name">
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Поле Фамилия -->
        <div class="mb - 3">
            <label for="last_name" class="form - label">Фамилия</label>
            <input type="text" class="form - control" id="last_name" wire:model.defer="last_name">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Поле Отчество -->
        <div class="mb - 3">
            <label for="middle_name" class="form - label">Отчество</label>
            <input type="text" class="form - control" id="middle_name" wire:model.defer="middle_name">
            @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Поле Дата рождения -->
        <div class="mb - 3">
            <label for="birthdate" class="form - label">Дата рождения</label>
            <input type="date" class="form - control" id="birthdate" wire:model.defer="birthdate">
            @error('birthdate') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Поле Email -->
        <div class="mb - 3">
            <label for="email" class="form - label">Email</label>
            <input type="email" class="form - control" id="email" wire:model.defer="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Поле Код страны -->
        <div class="mb - 3">
            <label for="country_code" class="form - label">Код страны</label>
            <select class="form - select" id="country_code" wire:model.defer="country_code">
                <option value=" + 375">+375</option>
                <option value=" + 7">+7</option>
            </select>
        </div>

        <!-- Поле Телефон -->
        <div class="mb - 3">
            <label for="phone" class="form - label">Телефон</label>
            <input type="tel" class="form - control" id="phone" wire:model.defer="phone">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Поле добавления дополнительных номеров телефона -->
        @if(isset($additional_phones))
            @foreach($additional_phones as $index => $phone)
                <div class="mb-3">
                    <label class="form-label">Дополнительный телефон {{ $index + 1 }}</label>
                    <input type="tel" class="form-control" wire:model="additional_phones.{{ $index }}.phone">
                    @error('additional_phones.'.$index.'.phone') <span
                        class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endforeach
        @endif


        <!-- Поле Семейное положение -->
        <div class="mb - 3">
            <label for="marital_status" class="form - label">Семейное положение</label>
            <select class="form - select" id="marital_status" wire:model.defer="marital_status">
                <option value="Холост / не замужем">Холост/не замужем</option>
                <option value="Женат / замужем">Женат/замужем</option>
                <option value="В разводе">В разводе</option>
                <option value="Вдовец / вдова">Вдовец/вдова</option>
            </select>
            @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Поле О себе -->
        <div class="mb - 3">
            <label for="about" class="form - label">О себе</label>
            <textarea class="form - control" id="about" rows="3" wire:model.defer="about"></textarea>
            @error('about') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Поле Файлы -->
        <div class="mb - 3">
            <label for="files" class="form - label">Файлы</label>
            <input type="file" class="form - control" id="files" wire:model="files" multiple>
            @error('files.*') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <button type="button" class="btn btn-secondary" wire:click="addAdditionalPhone()">Добавить телефон</button>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
