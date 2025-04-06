#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import cgi
import html
from datetime import datetime

DATA_FILE = 'go_devs_data.txt'

form = cgi.FieldStorage()
print("Content-type: text/html; charset=utf-8\n")

# HTML-шаблон с выводом hidden-поля
html_template = """
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Результаты анкеты Golang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {{
            --go-blue: #00ADD8;
            --go-dark: #375eab;
            --go-light: #E6EFF9;
        }}

        body {{
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f7fafc;
            margin: 0;
            padding: 2rem;
        }}

        .container {{
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }}

        h1 {{
            color: var(--go-dark);
            margin-top: 0;
            border-bottom: 2px solid var(--go-blue);
            padding-bottom: 0.5rem;
        }}

        table {{
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }}

        th, td {{
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }}

        th {{
            background-color: var(--go-light);
            color: var(--go-dark);
            width: 30%;
        }}

        .secret-info {{
            background-color: #fff5f5;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            border-left: 4px solid #e53e3e;
        }}
    </style>
</head>
<body>
    <div class="container">
        <h1>Результаты анкеты</h1>

        <table>
            <tr><th>Фамилия</th><td>{surname}</td></tr>
            <tr><th>Имя</th><td>{name}</td></tr>
            <tr><th>Email</th><td>{email}</td></tr>
            <tr><th>Уровень</th><td>{level}</td></tr>
            <tr><th>Технологии</th><td>{tech}</td></tr>
            <tr><th>Опыт</th><td>{experience}</td></tr>
            <tr><th>Комментарий</th><td>{comment}</td></tr>
        </table>

        <div class="secret-info">
            <h3>Секретный код:</h3>
            <p>{secret_code}</p>
        </div>
    </div>
</body>
</html>
"""


# Функция для безопасного получения значений
def get_form_value(field_name, default='не указано'):
    if field_name not in form:
        return default

    field = form[field_name]
    if isinstance(field, list):
        values = [html.escape(item.value) for item in field]
        return ', '.join(values)
    else:
        return html.escape(field.value)


# Получаем данные
data = {
    'surname': get_form_value('surname'),
    'name': get_form_value('name'),
    'email': get_form_value('email'),
    'level': get_form_value('level'),
    'tech': get_form_value('tech'),
    'experience': get_form_value('experience'),
    'comment': get_form_value('comment'),
    'secret_code': get_form_value('secret_code', 'не указан')
}

# Выводим результат
print(html_template.format(**data))

# Логируем данные (включая secret_code)
with open(DATA_FILE, 'a', encoding='utf-8') as f:
    f.write(f"{datetime.now().isoformat()}|"
            f"{data['surname']}|{data['name']}|{data['email']}|"
            f"{data['level']}|{data['tech']}|{data['experience']}|"
            f"{data['comment']}|{data['secret_code']}\n")