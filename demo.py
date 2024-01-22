from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time
import random

# Ruta al controlador de Edge (reemplázala con la ruta real de tu controlador)
edge_driver_path = r'C:\Users\cruz_\Downloads\edgedriver_win64\msedgedriver.exe'

# Configuración de opciones para Edge
edge_options = webdriver.EdgeOptions()

# Configurar el servicio de Edge con la ruta del ejecutable
edge_service = webdriver.EdgeService(executable_path=edge_driver_path)

# Inicializar el controlador de Edge
driver = webdriver.Edge(service=edge_service, options=edge_options)

# URL de tu formulario
formulario_url = "http://localhost/registro-personas"

# Número de registros a crear
numero_registros = 100

# Iterar para crear registros
for i in range(numero_registros):
    # Abrir el formulario
    driver.get(formulario_url)

    # Rellenar los campos del formulario
    driver.find_element(By.NAME, "nombre").send_keys("Nombre" + str(i))
    driver.find_element(By.NAME, "company").send_keys("Compañía" + str(i))
    
    # Seleccionar una persona visitada aleatoriamente
    personas_dropdown = driver.find_element(By.NAME, "id_persona_visitada")
    personas_options = personas_dropdown.find_elements(By.TAG_NAME, "option")
    selected_persona = random.choice(personas_options)
    selected_persona.click()
    
    driver.find_element(By.NAME, "rfc_o_matricula").send_keys("RFC" + str(i))
    driver.find_element(By.NAME, "depto").send_keys("Departamento" + str(i))
    
    # Enviar el formulario
    driver.find_element(By.NAME, "guardar").click()

    # Esperar un tiempo para evitar cargar el servidor
    time.sleep(1)

# Mantener el navegador abierto
while True:
    time.sleep(1)
