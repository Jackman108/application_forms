<div class="row justify-content-center">    <!-- /resources/views/livewire/form-component.blade.php -->
     <div class="mb-3">
         <h1 > Форма клиента </h1>
     </div>


        <!-- Форма для ввода данных -->
    <form method="POST" action="{{ route('submit.form') }}" wire:submit.prevent="submitForm "
          enctype="multipart/form-data">
        @csrf
        <!-- Поле Имя -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">Имя</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                       wire:model.live="first_name">
                @error('first_name')
                <div class="invalid-feedback">{{ 'Поле имени обязательно для заполнения.' }}</div> @enderror
            </div>
        </div>

        <!-- Поле Фамилия -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="last_name" class="form-label">Фамилия</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                       wire:model.live="last_name">
                @error('last_name')
                <div class="invalid-feedback">{{ 'Поле фамилии обязательно для заполнения.' }}</div> @enderror
            </div>
        </div>

        <!-- Поле Отчество -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="middle_name" class="form-label">Отчество</label>
                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name"
                       wire:model.defer="middle_name">
                @error('middle_name')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Поле Дата рождения -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Дата рождения</label>
                <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate"
                       wire:model.live="birthdate">
                @error('birthdate')
                <div class="invalid-feedback">{{ 'Поле даты рождения является обязательным.' }}</div> @enderror
            </div>
        </div>

        <!-- Поле Email -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                       wire:model.live="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Поля Код страны и Телефон -->
        <div class="mb-3 row">
            <!-- Поле Код страны -->
            <div class="col-md-2">
                <label for="country_code" class="form-label">Код страны</label>
                <select class="form-select @error('country_code') is-invalid @enderror" id="country_code"
                        wire:model.defer="country_code">
                    <option value="">--//--</option>
                    <option value="+375">+375</option>
                    <option value="+7">+7</option>
                </select>
                @error('country_code')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Поле Телефон -->
            <div class="col-md-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                       wire:model.live="phone" maxlength="10" >
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Кнопка добавления телефона -->
            <div class="col-auto align-self-end">
                <button type="button" class="btn btn-secondary"
                        wire:click="addAdditionalPhone">+</button>
            </div>
        </div>

        <!-- Поле добавления дополнительных номеров телефона -->
        @if(isset($additional_phones) && count($additional_phones) > 1)
            <div class="mb-3 col">
                @for($index = 1; $index < count($additional_phones); $index++)
                    <div class="col-md-3" style="margin-left: calc(100% - 84%);">
                        <input type="tel" class="form-control"
                               wire:model.live="additional_phones.{{ $index }}.phone" maxlength="10">
                        <label class="form-label">Доп. телефон {{ $index + 1 }}</label>
                        @error('additional_phones.'.$index.'.phone') <span
                            class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endfor
            </div>
        @endif

        <!-- Поле Семейное положение -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="marital_status" class="form-label">Семейное положение</label>
                <select class="form-select @error('marital_status') is-invalid @enderror" id="marital_status"
                        wire:model.defer="marital_status">
                    <option value="">--//--</option>
                    <option value="Холост / не замужем">Холост/не замужем</option>
                    <option value="Женат / замужем">Женат/замужем</option>
                    <option value="В разводе">В разводе</option>
                    <option value="Вдовец / вдова">Вдовец/вдова</option>
                </select>
                @error('marital_status')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Поле О себе -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="about" class="form-label">О себе</label>
                <textarea class="form-control @error('about') is-invalid @enderror" id="about"
                          style="max-height: 12em; overflow-y: auto;"
                          wire:model.live="about"></textarea>
                @error('about')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Поле Файлы -->
        <div class="mb-3">
            <div class="col-md-6">
                <label for="files" class="form-label">Файлы</label>
                <input type="file" class="form-control @error('files.*') is-invalid @enderror" id="files"
                       wire:model.live="files"
                       multiple>
                @error('files.*')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Чекбокс согласия с правилами -->
        <div class="mb-3 form-check">
            <div class="col-md-6">
                <input type="checkbox" class="form-check-input @error('agreed_to_terms') is-invalid @enderror"
                       id="agreed_to_terms" wire:model.live="agreed_to_terms">
                <label class="form-check-label" for="agreed_to_terms">Я ознакомился с правилами</label>
                @error('agreed_to_terms')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary" @if(!$this->allFieldsFilled()) disabled @endif>Отправить</button>
    </form>
</div>


