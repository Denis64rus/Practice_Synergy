import javax.swing.*;

// Передаем в Scroll текст и отсюда же его берем для обработчика saveFile
public class Scroll extends JScrollPane {

    private final String path;

    private final boolean isOpened;

    private final JTextArea text;

    // передаем текст
    public Scroll(JTextArea text, boolean isOpened, String path) {
        super(text);
        this.text = text;
        this.isOpened = isOpened;
        this.path = path;
    }

    // берем текст
    public String getText() {
        return text.getText();
    }

    public boolean isOpened() {
        return isOpened;
    }

    public String getPath() {
        return path;
    }

}
