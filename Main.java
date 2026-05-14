import java.util.HashMap;
import java.util.Scanner;

public class Main {

    // "Base de datos" en memoria
    static HashMap<String, String> users = new HashMap<>();

    public static void main(String[] args) {

        Scanner sc = new Scanner(System.in);

        while (true) {

            System.out.println("\n=== PIGEON SHOT VR LOGIN ===");
            System.out.println("1. Registrar");
            System.out.println("2. Iniciar sesión");
            System.out.println("3. Salir");
            System.out.print("Elige una opción: ");

            int opcion = sc.nextInt();
            sc.nextLine();

            if (opcion == 1) {
                System.out.print("Usuario: ");
                String user = sc.nextLine();

                System.out.print("Contraseña: ");
                String pass = sc.nextLine();

                users.put(user, pass);
                System.out.println("✔ Usuario registrado correctamente");

            } 
            else if (opcion == 2) {
                System.out.print("Usuario: ");
                String user = sc.nextLine();

                System.out.print("Contraseña: ");
                String pass = sc.nextLine();

                if (users.containsKey(user) && users.get(user).equals(pass)) {
                    System.out.println("✔ Login exitoso");
                    System.out.println("🎮 Bienvenido a Pigeon Shot VR");
                } else {
                    System.out.println("❌ Usuario o contraseña incorrectos");
                }

            } 
            else if (opcion == 3) {
                System.out.println("Saliendo...");
                break;
            } 
            else {
                System.out.println("Opción inválida");
            }
        }

        sc.close();
    }
}