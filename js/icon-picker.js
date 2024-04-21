jQuery(document).ready(function($) {
    // Показываем пикер иконок Кнопка выбрать иконку
    $('#choose-icon-button').click(function() {
        $('#icon-picker').show(); 
    });

    // исходное состояние инпута
    var originalIconHtml = $('#image-url').val();

    $('.icon-color-field').wpColorPicker({
        // Обработка события изменения цвета
        change: function(event, ui) {
            var newColor = ui.color.toString(); 
            // Применяем цвет к элементу превью
            $('#image-preview i').css('color', newColor);
        },
        // Обеспечиваем немедленное применение цвета при выборе
        clear: function() {
            $('#image-preview i').css('color', '');
        }
    });

    // Кнопка самой иконки
    $('.fa-icon-picker').click(function() {
        var color = $('#icon-color').val(); // Получаем текущий выбранный цвет
        var iconClass = $(this).data('icon');
        $(this).addClass('active');
        $('.fa-icon-picker').removeClass('active');
        $('#image-preview').html('<i class="' + iconClass + '" style="font-size: 50px; color: ' + color + ' "></i>'); // Показываем иконку 
        $('#image-url').val(iconClass);  //записываем классы в инпут
    });

    //обновляем превью после выбора цвета
    function updatePreview(color) {
        // Если цвет передан в функцию, обновляем цвет иконок
        if (color) {
            $('#image-preview i').css('color', color); // Обновляем цвет в превью
            $('.fa-icon-picker i').css('color', color); // Обновляем цвет всех иконок в пикере
        } else {
            // Если цвет не передан, просто обновляем превью с сохраненным HTML иконки
            $('#image-preview').html(originalIconHtml);
        }
        $('#image-preview').show(); // Показываем обновленное превью
    }
    
    $('.fa-icon-picker i').click(function() {
        var color = $(this).val(); // Получаем выбранный цвет
        updatePreview(color);
        console.log( color );
    });

    $('#confirm-icon-selection').click(function() {
        originalIconHtml = $('#image-preview').html(); // Обновляем исходное состояние иконки после подтверждения выбора
        $('#icon-picker').hide(); // Скрываем пикер иконок
    });
});
