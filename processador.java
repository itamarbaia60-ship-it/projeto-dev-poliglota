import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.sql.PreparedStatement;

public class Processador {

    public static void main(String[] args) {

        try (
            Connection con = DriverManager.getConnection(
                "jdbc:mysql://localhost:3306/sistema_poliglota",
                "root",
                ""
            )
        ) {

            Statement stmt = con.createStatement();

            ResultSet rs = stmt.executeQuery(
                "SELECT * FROM alunos WHERE matricula = 'Pendente' LIMIT 1"
            );

            if (rs.next()) {

                int id = rs.getInt("id");
                String nome = rs.getString("nome").toUpperCase();

                String matriculaFicticia = "MAT-" + (1000 + id);

                String sql = "UPDATE alunos SET nome = ?, matricula = ? WHERE id = ?";

                PreparedStatement pstmt = con.prepareStatement(sql);

                pstmt.setString(1, nome);
                pstmt.setString(2, matriculaFicticia);
                pstmt.setInt(3, id);

                pstmt.executeUpdate();

                System.out.println("Java processou o aluno: " + nome);
                System.out.println("Nova matrícula: " + matriculaFicticia);

                pstmt.close();

            } else {
                System.out.println("Nenhum aluno pendente para processar.");
            }

            rs.close();
            stmt.close();

        } catch (Exception e) {
            System.out.println("Erro ao processar aluno: " + e.getMessage());
        }
    }
}
