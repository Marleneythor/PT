import tkinter as tk
from tkinter import ttk
from tkinter import filedialog

class RequisitosInicioApp:
    def __init__(self, root):
        self.root = root
        self.root.title("Formulario de Requisitos de Inicio")
        
        self.opcion_counter = {}
        self.nombres_opciones = {
            '1': 'Tacos Azules',
            '2': 'Tacos Negros',
            '3': 'Nombre Opción 3',
            '7': 'Opción especial 7',  # Agrega nombres para las demás opciones según sea necesario
        }
        
        self.create_widgets()
    
    def create_widgets(self):
        main_frame = ttk.Frame(self.root, padding="20")
        main_frame.grid(row=0, column=0)
        
        ttk.Label(main_frame, text="Requisitos de Inicio", font=("Helvetica", 16, "bold")).grid(row=0, columnspan=2)
        
        opciones = ['Seleccione un Requisito'] + [f"Opción {i}" for i in range(1, 15)]
        ttk.Label(main_frame, text="Elige una opción:").grid(row=1, column=0, padx=5, pady=5)
        self.opciones_combo = ttk.Combobox(main_frame, values=opciones)
        self.opciones_combo.grid(row=1, column=1, padx=5, pady=5)
        self.opciones_combo.bind("<<ComboboxSelected>>", self.mostrar_descripcion)
        
        ttk.Label(main_frame, text="Descripción:").grid(row=2, column=0, padx=5, pady=5)
        self.descripcion_entry = ttk.Entry(main_frame, width=50, state="readonly")
        self.descripcion_entry.grid(row=2, column=1, padx=5, pady=5)
        
        self.boton_crear_documento = ttk.Button(main_frame, text="Crear documento", command=self.crear_documento)
        self.boton_crear_documento.grid(row=3, columnspan=2, pady=10)
        self.boton_crear_documento.state(["disabled"])
        
        self.vista_previa_frame = ttk.LabelFrame(main_frame, text="Vista Previa del Documento")
        self.vista_previa_frame.grid(row=4, columnspan=2, padx=5, pady=5)
        self.vista_previa_frame.grid_remove()
        
        self.iframe_vista_previa = tk.Text(self.vista_previa_frame, width=80, height=10)
        self.iframe_vista_previa.grid(row=0, column=0, padx=5, pady=5)
        
        
        ttk.Label(main_frame, text="Selecciona un archivo (PDF, Word o JPG no mayor a 700 KB):", anchor="center").grid(row=5, columnspan=3, pady=5)

        self.archivo_entry = ttk.Entry(main_frame, width=50, state="readonly")
        self.archivo_entry.grid(row=5, column=1, padx=5, pady=5)
        
        self.archivo_button = ttk.Button(main_frame, text="Buscar archivo", command=self.buscar_archivo)
        self.archivo_button.grid(row=5, column=2, padx=5, pady=5)
        
        self.subir_archivo_button = ttk.Button(main_frame, text="Subir Archivo", command=self.submit_form)
        self.subir_archivo_button.grid(row=6, columnspan=2, pady=10)
        
        ttk.Label(main_frame, text="Archivos Cargados", font=("Helvetica", 14, "bold")).grid(row=7, columnspan=2, padx=5, pady=5)
        
        self.archivos_treeview = ttk.Treeview(main_frame, columns=("Requisito", "Nombre", "Archivo", "Descargar", "Eliminar", "Vista Previa"))
        self.archivos_treeview.heading("#0", text="")
        self.archivos_treeview.heading("Requisito", text="Requisito")
        self.archivos_treeview.heading("Nombre", text="Nombre")
        self.archivos_treeview.heading("Archivo", text="Archivo")
        self.archivos_treeview.heading("Descargar", text="Descargar")
        self.archivos_treeview.heading("Eliminar", text="Eliminar")
        self.archivos_treeview.heading("Vista Previa", text="Vista Previa")
        self.archivos_treeview.grid(row=8, columnspan=2, padx=5, pady=5)

        for i in range(2, 8):
            main_frame.grid_rowconfigure(i, weight=1)
        
        # Configuración de expansión para las columnas
        main_frame.grid_columnconfigure(0, weight=1)
        main_frame.grid_columnconfigure(1, weight=1)
    
    def mostrar_descripcion(self, event):
        opcion_seleccionada = self.opciones_combo.get()
        descripcion = self.nombres_opciones.get(opcion_seleccionada, "Descripción predeterminada")
        self.descripcion_entry.configure(state="normal")
        self.descripcion_entry.delete(0, tk.END)
        self.descripcion_entry.insert(0, descripcion)
        self.descripcion_entry.configure(state="readonly")
        
        if opcion_seleccionada == "Opción 7":
            self.boton_crear_documento.state(["!disabled"])
        else:
            self.boton_crear_documento.state(["disabled"])
    
    def crear_documento(self):
        # Implementar la lógica para crear el documento
        pass
    
    def buscar_archivo(self):
        archivo = filedialog.askopenfilename(filetypes=[("Archivos admitidos", "*.pdf;*.doc;*.docx;*.jpg")])
        if archivo:
            self.archivo_entry.configure(state="normal")
            self.archivo_entry.delete(0, tk.END)
            self.archivo_entry.insert(0, archivo)
            self.archivo_entry.configure(state="readonly")
    
    def submit_form(self):
        opcion_seleccionada = self.opciones_combo.get()
        archivo_seleccionado = self.archivo_entry.get()
        
        # Implementar la lógica para subir el archivo y mostrar en el Treeview
        pass

def main():
    root = tk.Tk()
    app = RequisitosInicioApp(root)
    
    # Configuración de expansión para la ventana principal
    root.grid_rowconfigure(0, weight=1)
    root.grid_columnconfigure(0, weight=1)
    
    root.mainloop()

if __name__ == "__main__":
    main()
