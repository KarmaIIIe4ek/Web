#!/usr/bin/env python3
import cgi

# Заголовок HTTP-ответа
print("Content-Type: text/html\n")

# Получение данных из формы
form = cgi.FieldStorage()

surname = form.getvalue('surname', 'не указано')
name = form.getvalue('name', 'не указано')
patronymic = form.getvalue('patronymic', 'не указано')
email = form.getvalue('email', 'не указано')
main = form.getvalue('main', 'не указано')
job = form.getvalue('job', 'не указано')
messenger = form.getlist('messenger')
hidden_field = form.getvalue('hidden_field', 'не указано')  # Получаем значение скрытого поля

# Формирование HTML-ответа
print(f"""
<html>
<head><title>Результаты анкеты</title></head>
<body>
    <h1>Результаты анкеты</h1>
    <p>{name[0]}.{patronymic[0]}. {surname} является {job}, для него главное {main} и любит мессенджер {', '.join(messenger)}.</p>
    <table border="1">
        <tr><th>Поле</th><th>Значение</th></tr>
        <tr><td>Фамилия</td><td>{surname}</td></tr>
        <tr><td>Имя</td><td>{name}</td></tr>
        <tr><td>Отчество</td><td>{patronymic}</td></tr>
        <tr><td>Электронная почта</td><td>{email}</td></tr>
        <tr><td>Главное для вас</td><td>{main}</td></tr>
        <tr><td>Кто ты</td><td>{job}</td></tr>
        <tr><td>Любимый мессенджер</td><td>{', '.join(messenger)}</td></tr>
        <tr><td>Скрытое поле</td><td>{hidden_field}</td></tr>  <!-- Добавлено скрытое поле -->
    </table>
</body>
</html>
""")

# Запись данных в файл (расширенное задание)
with open("data.txt", "a", encoding="utf-8") as file:
    file.write(f"{surname},{name},{patronymic},{email},{main},{job},{','.join(messenger)},{hidden_field}\n")