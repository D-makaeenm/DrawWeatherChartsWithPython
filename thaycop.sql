USE [thaycop]
GO

/****** Object:  Table [dbo].[thoi_tiet]    Script Date: 14/05/2024 11:24:08 CH ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[thoi_tiet](
	[City] [nvarchar](255) NULL,
	[Date] [date] NULL,
	[Temperature] [float] NULL,
	[Humidity] [float] NULL,
	[Pressure] [float] NULL
) ON [PRIMARY]
GO

USE [thaycop]
GO
/****** Object:  StoredProcedure [dbo].[GetThoiTietData]    Script Date: 14/05/2024 11:25:20 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[GetThoiTietData]
AS
BEGIN
    SELECT * FROM thoi_tiet;
END

