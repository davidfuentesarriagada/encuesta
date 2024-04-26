package html.dashboard.auth;

public class RegistroAbordaje {

    // Método principal donde se ejecuta el programa
    public static void main(String[] args) {
        // Array de ejemplo con nombres de pasajeros
        String[] listaPasajeros = {"Alice", "Bob", "Charlie", "David"};

        // Llamada al método para procesar la consulta de un pasajero
        int indicePasajero = 5;  // Un índice intencionalmente fuera de rango para provocar la excepción
        consultarPasajero(listaPasajeros, indicePasajero);
    }

    // Método para consultar un pasajero en el arreglo por índice
    public static void consultarPasajero(String[] pasajeros, int indice) {
        try {
            // Intento de acceder a un índice del arreglo
            System.out.println("Pasajero en el índice " + indice + ": " + pasajeros[indice]);
        } catch (ArrayIndexOutOfBoundsException e) {
            // Manejo del error cuando el índice está fuera de rango
            System.err.println("Error: Índice " + indice + " está fuera de rango.");
            // Proceso de recuperación: Mostrar el último pasajero válido
            int ultimoIndiceValido = pasajeros.length - 1;
            System.out.println("Mostrando el último pasajero válido en el índice " + ultimoIndiceValido + 
            ": " + pasajeros[ultimoIndiceValido]);
        } finally {
            // Este bloque se ejecuta siempre, independientemente de si se lanzó una excepción
            System.out.println("Consulta completada.");
        }
    }
}