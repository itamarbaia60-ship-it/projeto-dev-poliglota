import mysql.connector

conexao = mysql.connector.connect(host="localhost", user="root", password="", database="sistema_poliglota")

cursor = conexao.cursor()

cursor.execute("SELECT id, nome, curso, matricula FROM alunos WHERE matricula != 'Pendente")

resultados = cursor.fetchall()

print("="*45)
print(" RELATÓRIO FINAL DOS ALUNOS (MÓDULO PYTHON) ")
print("=" * 45)

for row in resultados:
    print(f" ID : {row[0]}")
    print(f" Nome: {row[1]}")
    print(f" Curso: {row[2]}")
    print(f" Matrícula: {row[3]}")
    print("-"*45)
conexao.close()