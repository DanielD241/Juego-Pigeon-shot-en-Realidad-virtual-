import java.sql.*;
import java.util.Scanner;

public class PigeonGame {

    static Connection conn;

    public static void main(String[] args) {

        try {
            connect();
            createTables();

            Scanner sc = new Scanner(System.in);

            while (true) {

                System.out.println("\n🎮 PIGEON SHOT VR");
                System.out.println("1. Registrar");
                System.out.println("2. Login");
                System.out.println("3. Guardar puntos");
                System.out.println("4. Ranking");
                System.out.println("5. Salir");
                System.out.print("Opción: ");

                int op = sc.nextInt();
                sc.nextLine();

                if (op == 1) register(sc);
                else if (op == 2) login(sc);
                else if (op == 3) saveScore(sc);
                else if (op == 4) ranking();
                else if (op == 5) break;
            }

        } catch (Exception e) {
            System.out.println("❌ Error: " + e.getMessage());
        }
    }

    /* =========================
       CONEXIÓN MYSQL
    ========================= */
    static void connect() throws Exception {
        conn = DriverManager.getConnection(
            "jdbc:mysql://localhost:3306/pigeon_game?useSSL=false&serverTimezone=UTC",
            "root",
            "tu_password"
        );

        System.out.println("✔ Conectado a MySQL");
    }

    /* =========================
       CREAR TABLAS
    ========================= */
    static void createTables() throws Exception {

        Statement st = conn.createStatement();

        st.execute("CREATE TABLE IF NOT EXISTS users (" +
                "id INT AUTO_INCREMENT PRIMARY KEY," +
                "username VARCHAR(50) UNIQUE," +
                "password VARCHAR(50))");

        st.execute("CREATE TABLE IF NOT EXISTS scores (" +
                "id INT AUTO_INCREMENT PRIMARY KEY," +
                "username VARCHAR(50)," +
                "points INT)");

        System.out.println("✔ Tablas listas");
    }

    /* =========================
       REGISTRO
    ========================= */
    static void register(Scanner sc) throws Exception {

        System.out.print("Usuario: ");
        String user = sc.nextLine();

        System.out.print("Password: ");
        String pass = sc.nextLine();

        PreparedStatement ps = conn.prepareStatement(
            "INSERT INTO users(username,password) VALUES(?,?)"
        );

        ps.setString(1, user);
        ps.setString(2, pass);

        ps.executeUpdate();

        System.out.println("✔ Usuario registrado");
    }

    /* =========================
       LOGIN
    ========================= */
    static void login(Scanner sc) throws Exception {

        System.out.print("Usuario: ");
        String user = sc.nextLine();

        System.out.print("Password: ");
        String pass = sc.nextLine();

        PreparedStatement ps = conn.prepareStatement(
            "SELECT * FROM users WHERE username=? AND password=?"
        );

        ps.setString(1, user);
        ps.setString(2, pass);

        ResultSet rs = ps.executeQuery();

        if (rs.next()) {
            System.out.println("✔ LOGIN OK 🎮");
        } else {
            System.out.println("❌ ERROR LOGIN");
        }
    }

    /* =========================
       GUARDAR PUNTOS
    ========================= */
    static void saveScore(Scanner sc) throws Exception {

        System.out.print("Usuario: ");
        String user = sc.nextLine();

        System.out.print("Puntos: ");
        int points = sc.nextInt();
        sc.nextLine();

        PreparedStatement ps = conn.prepareStatement(
            "INSERT INTO scores(username,points) VALUES(?,?)"
        );

        ps.setString(1, user);
        ps.setInt(2, points);

        ps.executeUpdate();

        System.out.println("✔ Puntos guardados");
    }

    /* =========================
       RANKING
    ========================= */
    static void ranking() throws Exception {

        System.out.println("\n🏆 RANKING:");

        Statement st = conn.createStatement();

        ResultSet rs = st.executeQuery(
            "SELECT username, SUM(points) AS total " +
            "FROM scores GROUP BY username ORDER BY total DESC"
        );

        while (rs.next()) {
            System.out.println(rs.getString("username") +
                    " -> " + rs.getInt("total"));
        }
    }
}