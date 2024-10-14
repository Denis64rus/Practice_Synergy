import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;

public class Main {
    
    // Переменная для имени файла (для tabs)
    private final String NAME = "Новый файл";

    // окно для saveFile
    private JFileChooser f = new JFileChooser();

    // для закладок файлов(переключение между ними)
    private JTabbedPane tabs = new JTabbedPane();

    public static void main(String[] args) {

        SwingUtilities.invokeLater(new Runnable() {

            public void run() {
                new Main();
            }
        });
    }

    public Main() {

        // Меню
        JMenuBar menu = new JMenuBar();

        JMenu file = new JMenu("Файл");

        JMenuItem newFile  = new JMenuItem("Создать");
        JMenuItem openFile = new JMenuItem("Открыть");
        JMenuItem saveFile = new JMenuItem("Сохранить");

        // Добавляем элементы в file
        file.add(newFile);
        file.add(openFile);
        file.add(saveFile);

        // Добавляем file в menu
        menu.add(file);

        // Оновное окно
        JFrame window = new JFrame("Notebook");
        window.setSize(800, 600);

        // Устанавливаем menu
        window.setJMenuBar(menu);

        window.add(tabs);

        window.setResizable(false);
        window.setLocationRelativeTo(null);
        window.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        window.setVisible(true);

        // Добавляем элементам menu обработчики событий

        // Создать файл
        newFile.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {

                // Добавляем scroll в text(JTextArea)
                JTextArea text = new JTextArea();

                Scroll scroll = new Scroll(text, false, "");

                // Добавляем имя файла в tabs
                tabs.addTab(NAME, scroll);
            }
        });

        // Сохранить файл
        saveFile.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                // необходимо получить содержимое Scroll
                Scroll text = (Scroll)tabs.getSelectedComponent();

                String output = text.getText();

                // если есть открытые файлы
                if (tabs.countComponents() != 0) {
                    if (text.isOpened()) {

                        try {
                            FileOutputStream writer = new FileOutputStream(text.getPath());
                            writer.write(output.getBytes());
                        } catch (IOException eq) {eq.printStackTrace();}

                    } else {
                        // окно выбора сохранения файла
                        f.showSaveDialog(null);

                        File file = f.getSelectedFile();

                        try {
                            FileOutputStream writer = new FileOutputStream(file);
                            writer.write(output.getBytes());
                        } catch (IOException eq) {eq.printStackTrace();}

                    }
                }
            }
        });

        // Открыть файл
        openFile.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                try {
                    // окно выбора открытия файла
                    f.showOpenDialog(null);
                    File file = f.getSelectedFile();

                    String input = new String(Files.readAllBytes(Paths.get(file.getAbsolutePath())));

                    // записываем в input содержимое файла (text)
                    JTextArea text = new JTextArea(input);

                    Scroll scroll = new Scroll(text, true, file.getAbsolutePath());

                    tabs.addTab(file.getName(), scroll);

                } catch (IOException ex) {ex.printStackTrace();}
            }
        });
    }
}