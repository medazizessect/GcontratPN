VERSION 5.00

Begin VB.Form PremEcr
    Caption = "Form32"
    BackColor = -2147483635
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 0
    LinkTopic = "Form32"
    ClientLeft   = 0
    ClientTop    = 0
    ClientWidth  = 5655
    ClientHeight = 8055
    ShowInTaskbar = 0              'False
    StartupPosition = 2
    Begin VB.Timer Timer4
        Interval = 5
        Left = 0
        Top = 1200
    End
    Begin VB.Timer Timer2
        Interval = 5
        Left = 0
        Top = 0
    End
    Begin VB.Timer Timer3
        Interval = 5
        Left = 0
        Top = 600
    End
    Begin VB.PictureBox Picture1
        Picture = PremEcr.frx:0000
        Left   = 120
        Top    = 120
        Width  = 5415
        Height = 7815
        TabIndex = 0
        ScaleMode = 1
        AutoRedraw = 0              'False
        FontTransparent = -1              'True
        Begin VB.Label Label2
            Caption = "C?E??? ?? ?E?C??CE ??? C???C??"
            BackColor = 16777215
            ForeColor = 16711680
            Left   = 0
            Top    = 6840
            Width  = 5350
            Height = 615
            TabIndex = 2
            BorderStyle = 1
            Alignment = 2
            BeginProperty Font
                Name          = "Tahoma"
                Size          = 11,25
                Charset       = 178
                Weight        = 700
                Underline     = 0              'False
                Italic        = 0              'False
                Strikethrough = 0              'False
            EndProperty
        End
        Begin VB.Label Label1
            Caption = "Label1"
            BackColor = 16777215
            ForeColor = 12583104
            Left   = 0
            Top    = 7440
            Width  = 5415
            Height = 350
            TabIndex = 1
            BorderStyle = 1
        End
    End
    Begin VB.Timer Timer1
        Interval = 5500
        Left = 1440
        Top = 120
    End
    Begin VB.Shape Carre1
        BackColor = 65535
        BorderColor = 0
        Left   = 0
        Top    = 0
        Width  = 135
        Height = 135
        BackStyle = 1
    End
    Begin VB.Shape Carre2
        BackColor = 65535
        BorderColor = 0
        Left   = 5520
        Top    = 7920
        Width  = 135
        Height = 135
        BackStyle = 1
    End
    Begin VB.Shape Shape1
        BackColor = 16711680
        BorderColor = 16777215
        Left   = 0
        Top    = 7920
        Width  = 5655
        Height = 135
        BackStyle = 1
    End
    Begin VB.Shape Shape4
        BackColor = 16711680
        BorderColor = 16777215
        Left   = 0
        Top    = 120
        Width  = 135
        Height = 7815
        BackStyle = 1
    End
    Begin VB.Shape Shape3
        BackColor = 16711680
        BorderColor = 16777215
        Left   = 0
        Top    = 0
        Width  = 5655
        Height = 135
        BackStyle = 1
    End
    Begin VB.Shape Shape2
        BackColor = 16711680
        BorderColor = 16777215
        Left   = 5520
        Top    = 120
        Width  = 135
        Height = 7815
        BackStyle = 1
    End
End
