 <form action="" method="post">



<div class="title-box">Обращение</div>

<div class="form-box">

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['NAME'])) ?>" <?=(array_key_exists('NAME', $msg) ? 'class="error"' : '')?> id="surname" type="text" name="NAME" placeholder="Фамилия"/>
    </div>

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['NAME'])) ?>" <?=(array_key_exists('NAME', $msg) ? 'class="error"' : '')?> id="name" type="text" name="NAME2" placeholder="Имя"/>
    </div>

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['NAME'])) ?>" <?=(array_key_exists('NAME', $msg) ? 'class="error"' : '')?> id="patronymic" type="text" name="NAME3" placeholder="Отчество"/>
        <script>
            // Замените на свой API-ключ
            var token = "45048b9be5a8c93c654feb005303bae03804ca62";

            // Инициализирует подсказки по ФИО на указанном элементе
            function init($surname, $name, $patronymic) {
            var self = {};
            self.$surname = $surname;
            self.$name = $name;
            self.$patronymic = $patronymic;
            var fioParts = ["SURNAME", "NAME", "PATRONYMIC"];
            $.each([$surname, $name, $patronymic], function(index, $el) {
                var sgt = $el.suggestions({
                token: token,
                type: "NAME",
                triggerSelectOnSpace: false,
                hint: "",
                noCache: true,
                params: {
                    // каждому полю --- соответствующая подсказка
                    parts: [fioParts[index]]
                },
                onSearchStart: function(params) {
                    // если пол известен на основании других полей,
                    // используем его
                    var $el = $(this);
                    params.gender = isGenderKnown.call(self, $el) ? self.gender : "UNKNOWN";
                },
                onSelect: function(suggestion) {
                    // определяем пол по выбранной подсказке
                    self.gender = suggestion.data.gender;
                }
                });
            });
            };

            // Проверяет, известен ли пол на данный момент
            function isGenderKnown($el) {
            var self = this;
            var surname = self.$surname.val(),
                name = self.$name.val(),
                patronymic = self.$patronymic.val();
            if (($el.attr('id') == self.$surname.attr('id') && !name && !patronymic) ||
                ($el.attr('id') == self.$name.attr('id') && !surname && !patronymic) ||
                ($el.attr('id') == self.$patronymic.attr('id') && !surname && !name)) {
                return false;
            } else {
                return true;
            }
            }

            init($("#surname"), $("#name"), $("#patronymic"));
        </script>
    </div>

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['ADDR'])) ?>" <?=(array_key_exists('ADDR', $msg) ? 'class="error"' : '')?> id="address" type="text" name="ADDR" placeholder="Почтовый адрес"/>
        <script>
            var $address = $("#address");
            var $message = $("#message");
            var $continue = $("#continue");
            var selectedAddress;

            function selectAddress(suggestion) {
            console.log(suggestion);
            if (suggestion.data.house) {
                $message.text("Отлично, можно продолжать!");
                $continue.prop("disabled", false);
            } else {
                $message.text("Укажите адрес до дома, чтобы продолжить");
                $continue.prop("disabled", true);
            }
            selectedAddress = suggestion.data;
            }

            function selectNone() {
            selectedAddress = null;
            $message.text("Вы не ввели адрес");
            $continue.prop("disabled", true);
            }

            $address.suggestions({
            token: token,
            type: "ADDRESS",
            onSelect: selectAddress,
            onSelectNothing: selectNone
            });

            // function formatSelected(suggestion) {
            // if (suggestion.data.postal_code) {
            //  return suggestion.data.postal_code + ', ' + suggestion.value;
            // } else {
            //  return suggestion.value;
            // }
            // }

            // $("#address").suggestions({
            // // Замените на свой API-ключ
            // token: token,
            // type: "ADDRESS",
            // formatSelected: formatSelected
            // });
        </script>
    </div>
    <div><p id="message"></p></div>

    <div class="item">
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['MAIL'])) ?>" <?=(array_key_exists('MAIL', $msg) ? 'class="error"' : '')?> id="email" type="text" name="MAIL" placeholder="E-mail"/>
        <script>
            $("#email").suggestions({
            // Замените на свой API-ключ
            token: token,
            type: "EMAIL",
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                console.log(suggestion);
            }
            });
        </script>
    </div>

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <input value="<?= trim(htmlspecialcharsbx(@$_REQUEST['PHONE'])) ?>" <?=(array_key_exists('PHONE', $msg) ? 'class="error"' : '')?> type="text" name="PHONE" placeholder="Контактный телефон"/>
    </div>

    <form method="post" action="act.php" target="ifr">
        <div class="item">
        <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
            <input name="code" placeholder="Код подтверждения">&nbsp;
            <input type="submit" name="sendsms" value="Выслать код">
            <input type="submit" name="ok" value="Подтвердить"><td colspan="2" id="_out">
        </div>
    </form>
    <iframe name="ifr" frameborder="0" height="0" width="0" style="visibility:hidden"></iframe>

    <div class="item">
    <a style="color:#ff0000" title="Обязательно для заполнения">*</a>
        <textarea <?=(array_key_exists('MESSAGE', $msg) ? 'class="error"' : '')?> name="MESSAGE" placeholder="Текст обращения"><?= trim(htmlspecialcharsbx(@$_REQUEST['MESSAGE'])) ?></textarea>
    </div>

  <div class="item">
    <input type="checkbox" name="personal" value="Y" <?if($_REQUEST['personal'] == 'Y'):?>checked<?endif;?>/> <a href="/obrabotka-personalnykh-dannykh/">Согласен</a> с обработкой персональных данных <?=(array_key_exists('personal', $msg) ? '<span style="color: #d7252c;">(обязательно)</span>' : '')?>
  </div>

    <?if(count($suc)):?>
        <div class="success"><?=implode('<br/>', $suc)?></div>
    <?endif;?>

    <p style="color:#ff0000" >* - поле обязательно к заполнению</p>

    <div class="bt">
        <button type="submit" id="continue" disabled>отправить</button>
    </div>

    <div class="cancel">
        <a href="" class="button">Отменить</a>
    </div>

</div>

</form>
