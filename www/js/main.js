$(function () {
  var placesAutocomplete = places({
    container: document.querySelector('#address-input'),
    countries: ['mx'],
    useDeviceLocation: true,
    type: 'address'
      //appId: 'GBMO0EV55O',
      //apiKey: 'f4b9c0f04f99c8cd38875f6d219f6425'
  });
  placesAutocomplete.on('change', e => {
    let data = e.suggestion;
    let filtros = {
      q: data.name,
      estado: data.administrative,
      municipio: data.city,
      codigoPostal: data.hit.postcode,
      direccion: data.value,
      colonia: data.name
    };
    let parametros = $.param(filtros);
    let url = `terrenos.php?${parametros}`;
    console.log(data, filtros, parametros);
    window.location = url;
  });
});

function escapeSpecialChars(jsonString) {
  return jsonString.replace(/\n/g, "\\n")
    .replace(/\r/g, "\\r")
    .replace(/\t/g, "\\t")
    .replace(/\f/g, "\\f");
}
