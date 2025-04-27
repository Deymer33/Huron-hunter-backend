// Aquí puedes poner la lógica real de búsqueda
// Por ahora, te devuelvo resultados falsos

exports.search = async (query) => {
    // Aquí luego puedes consultar tu base de datos o tu JSON
    console.log("Buscando:", query);
  
    // Resultado de ejemplo
    const fakeResults = [
      { id: 1, title: "Resultado relacionado a " + query },
      { id: 2, title: "Otro resultado de " + query },
    ];
  
    return fakeResults;
  };
  