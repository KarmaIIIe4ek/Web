#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import cgi
import sys
from datetime import datetime

# Настройки для записи в файл
DATA_FILE = 'form_data.txt'

# Получаем данные из формы
form = cgi.FieldStorage()

# Устанавливаем заголовок
print("Content-type: text/html; charset=utf-8\n")

# HTML-шаблон для ответа
html_template = """
<!DOCTYPE html>
<html>
<head>
    <title>Результаты анкеты</title>
    <meta charset="utf-8">
    <style>
        body {{
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }}
        h1 {{
            color: #333;
        }}
        table {{
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }}
        th, td {{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }}
        th {{
            background-color: #4CAF50;
            color: white;
            width: 30%;
        }}
        tr:nth-child(even) {{
            background-color: #f2f2f2;
        }}
        .result-phrase {{
            margin: 20px;
            padding: 15px;
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            font-size: 18px;
        }}
    </style>
</head>
<body>
    <h1>Результаты анкеты</h1>
    <table border="1">
        {table_rows}
    </table>
    <div class="result-phrase">
        {result_phrase}
    </div>
</body>
</html>
"""


# Функция для получения значения из формы
def get_form_value(field_name, default='(не указано)'):
    if field_name not in form:
        return default

    field = form[field_name]
    if isinstance(field, list):
        values = [item.value for item in field]
        return ', '.join(values)
    else:
        return field.value


# Получаем данные из формы
surname = get_form_value('surname')
name = get_form_value('name')
middlename = get_form_value('middlename')
shoesize = get_form_value('shoesize')
job = get_form_value('job')
language = get_form_value('language')
email = get_form_value('email')
comment = get_form_value('comment')
hidden_field = get_form_value('hidden_field')

# Формируем строку с результатом
initials = f"{name[0]}.{middlename[0]}." if name and middlename else ""
result_phrase = f"{initials} {surname} является {job}, носит {shoesize} размер обуви и любит язык {language}."

# Формируем строки таблицы
fields = [
    ('Фамилия', surname),
    ('Имя', name),
    ('Отчество', middlename),
    ('Размер обуви', shoesize),
    ('Должность', job),
    ('Любимый язык программирования', language),
    ('Электронная почта', email),
    ('Комментарий', comment),
    ('Скрытое поле', hidden_field)
]

table_rows = ""
for field_name, field_value in fields:
    table_rows += f"<tr><th>{field_name}</th><td>{field_value}</td></tr>"

# Выводим результат
print(html_template.format(table_rows=table_rows, result_phrase=result_phrase))

# Записываем данные в файл (без названий полей)
with open(DATA_FILE, 'a', encoding='utf-8') as f:
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    data_line = f"{timestamp}|{surname}|{name}|{middlename}|{shoesize}|{job}|{language}|{email}|{comment}|{hidden_field}\n"
    f.write(data_line)