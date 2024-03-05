@livewireStyles

<div>
    <!-- Отображение ошибок -->
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Форма для ввода данных -->
    <form wire:submit.prevent=submitForm">
        <!-- Поле Имя -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="first_name" wire:model.defer="first_name">
            @if($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
        </div>

        <!-- Поле Фамилия -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="last_name" wire:model.defer="last_name">
            @if($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
        </div>

        <!-- Поле Отчество -->
        <div class="mb-3">
            <label for="middle_name" class="form-label">Отчество</label>
            <input type="text" class="form-control" id="middle_name" wire:model.defer="middle_name">
            @if($errors->has('middle_name'))
                <span class="text-danger">{{ $errors->first('middle_name') }}</span>
            @endif
        </div>

        <!-- Поле Дата рождения -->
        <div class="mb-3">
            <label for="birthdate" class="form-label">Дата рождения</label>
            <input type="date" class="form-control" id="birthdate" wire:model.defer="birthdate">
            @if($errors->has('birthdate'))
                <span class="text-danger">{{ $errors->first('birthdate') }}</span>
            @endif
        </div>

        <!-- Поле Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" wire:model.defer="email">
            @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Поле Телефон -->
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" class="form-control" id="phone" wire:model.defer="phone">
            @if($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <!-- Поле Код страны -->
        <div class="mb-3">
            <label for="country_code" class="form-label">Код страны</label>
            <select class="form-select" id="country_code" wire:model.defer="country_code">
                <option value="+375">+375</option>
                <option value="+7">+7</option>
            </select>
            @if($errors->has('country_code'))
                <span class="text-danger">{{ $errors->first('country_code') }}</span>
            @endif
        </div>

        <!-- Поле Семейное положение -->
        <div class="mb-3">
            <label for="marital_status" class="form-label">Семейное положение</label>
            <select class="form-select" id="marital_status" wire:model.defer="marital_status">
                <option value="Холост/не замужем">Холост/не замужем</option>
                <option value="Женат/замужем">Женат/замужем</option>
                <option value="В разводе">В разводе</option>
                <option value="Вдовец/вдова">Вдовец/вдова</option>
            </select>
            @if($errors->has('marital_status'))
                <span class="text-danger">{{ $errors->first('marital_status') }}</span>
            @endif
        </div>

        <!-- Поле О себе -->
        <div class="mb-3">
            <label for="about" class="form-label">О себе</label>
            <textarea class="form-control" id="about" rows="3" wire:model.defer="about"></textarea>
            @if($errors->has('about'))
                <span class="text-danger">{{ $errors->first('about') }}</span>
            @endif
        </div>

        <!-- Поле Файлы -->
        <div class="mb-3">
            <label for="files" class="form-label">Файлы</label>
            <input type="file" class="form-control" id="files" wire:model="files" multiple>
            @if($errors->has('files.*'))
                <span class="text-danger">{{ $errors->first('files.*') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

@livewireScripts
